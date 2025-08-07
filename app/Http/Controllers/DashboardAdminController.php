<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\AbsensiGuru;
use App\Models\AbsensiMurid;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Mengambil data statistik dari database lokal
        $totalGuru = User::whereHas('role', fn($q) => $q->where('name', 'Guru'))->count();
        $totalMurid = User::whereHas('role', fn($q) => $q->where('name', 'Siswa'))->count();
        $totalKelas = Kelas::count();
        $totalAbsensiGuru = AbsensiGuru::count();
        $totalAbsensiMurid = AbsensiMurid::count();

        // Mengembalikan tampilan dashboard dan mengirimkan data ke view
        return view('admin.dashboard.index', [
            'totalGuru' => $totalGuru,
            'totalMurid' => $totalMurid,
            'totalKelas' => $totalKelas,
            'totalAbsensiGuru' => $totalAbsensiGuru,
            'totalAbsensiMurid' => $totalAbsensiMurid,
        ]);
    }
}
