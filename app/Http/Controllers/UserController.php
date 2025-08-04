<?php

namespace App\Http\Controllers;
use App\Services\MoodleService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(['auth:sanctum']);

        // Cek role hanya Admin
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role->name !== 'Admin') {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $users = User::with('role')
            ->whereHas('role', function ($q) {
                $q->whereIn('name', ['Guru', 'Siswa']);
            })
            ->paginate($request->get('per_page', 10));

        return response()->json($users);
    }

    public function store(Request $request, MoodleService $moodle)
{
    // Validasi data lokal
    $request->validate([
        'username' => 'required',
        'email' => 'required|email',
        'firstname' => 'required',
        'lastname' => 'required',
        'password' => 'required',
    ]);

    // Simpan ke database Laravel
    $user = User::create([
        'name' => $request->firstname . ' ' . $request->lastname,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // Kirim ke Moodle
    $moodleUser = [
        'username' => $request->username,
        'password' => $request->password,
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'email' => $request->email,
    ];

    $moodleResponse = $moodle->createUser($moodleUser);

    return redirect()->back()->with('success', 'User berhasil dibuat di Laravel dan Moodle!');
}

    public function show($id)
    {
        $user = User::with('role')->findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'sometimes|string',
            'email'    => 'nullable|email|unique:users,email,' . $id,
            'nisn'     => 'nullable|string|unique:users,nisn,' . $id,
            'password' => 'nullable|string|min:6',
            'role_id'  => 'sometimes|exists:roles,id',
        ]);

        $user->update([
            'name'     => $request->name ?? $user->name,
            'email'    => $request->email ?? $user->email,
            'nisn'     => $request->nisn ?? $user->nisn,
            'role_id'  => $request->role_id ?? $user->role_id,
        ]);

        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return response()->json([
            'message' => 'User updated',
            'user'    => $user,
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() == $user->id) {
            return response()->json(['message' => 'Tidak bisa menghapus akun sendiri'], 403);
        }

        $user->delete();

        return response()->json([
            'message' => 'User deleted'
        ]);
    }
}
