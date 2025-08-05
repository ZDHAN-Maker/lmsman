<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Kelas;
use App\Models\Role;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Http\Request;

class KelasAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::with('guru', 'semester')->get();
        $gurus = User::guru()->get();
        $semesters = Semester::all();

        return view('admin.kelas.kelas_admin.index', compact('kelas', 'gurus', 'semesters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guruRoleId = Role::where('name', 'Guru')->value('id');
        $gurus = User::where('role_id', $guruRoleId)->get();
        return view('admin.kelas.kelas_admin.create', compact('gurus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'guru_id' => 'required|exists:users,id',
            'semester_id' => 'required|exists:semesters,id',
            'kode_kelas' => 'required|unique:kelas,kode_kelas'
        ]);

        Kelas::create([
            'name' => $request->name,
            'guru_id' => $request->guru_id,
            'semester_id' => $request->semester_id,
            'kode_kelas' => $request->kode_kelas
        ]);

        return redirect()->route('admin.kelas.kelas_admin.store')->with('success', 'Kelas berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
