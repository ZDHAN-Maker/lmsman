<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Panggil method authenticate() pada request
        $request->authenticate();

        // Regenerate session
        $request->session()->regenerate();

        // Ambil user yang sudah terautentikasi dari request atau guard Auth
        $user = Auth::user(); // Gunakan Auth::user() setelah autentikasi berhasil

        // Ambil nama role pengguna
        $role = $user->role->name;

        // Redirect berdasarkan nama role
        switch ($user->role->name) {
            case 'Admin':
                return redirect()->intended('/admin/dashboard');
            case 'Guru':
                return redirect()->intended('/guru/dashboard');
            case 'Siswa':
                return redirect()->intended('/siswa/dashboard');
            default:
                Auth::logout(); // Logout jika role tidak dikenali
                return redirect('/login')->withErrors(['role' => 'Role tidak valid']);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}