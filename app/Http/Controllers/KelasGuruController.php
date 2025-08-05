<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasGuruController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $kelas = Kelas::with('guru')->get();
        return view('kelas.kelas_guru.index', compact('kelas'));
    }

    
}
