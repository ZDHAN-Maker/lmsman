<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = User::guru()->get();
        return view('admin.daftar_siswa.index', compact('siswa'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv,txt',
        ]);

        try {
            Excel::import(new SiswaImport, $request->file('file'));

            return redirect()->route('admin.daftar_siswa.index')
                ->with('success', 'Data siswa berhasil diimpor!');
        } catch (\Exception $e) {
            Log::error('Import Siswa Gagal: ' . $e->getMessage());

            return redirect()->route('admin.daftar_siswa.index')
                ->with('error', 'Terjadi kesalahan saat mengimpor file. Pastikan format sesuai.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'NISN' => 'required|string|unique:siswas,NISN',
            'jenkel' => 'required|in:L,P',
        ]);

        // 2. Buat user baru terlebih dahulu
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 3, // Asumsikan role_id untuk siswa adalah 3
        ]);

        // 3. Buat data siswa terkait
        $siswa = new Siswa([
            'user_id' => $user->id,
            'nama' => $request->name,
            'NISN' => $request->NISN,
            'jenkel' => $request->jenkel,
        ]);

        $user->siswa()->save($siswa);

        // 4. Redirect dengan pesan sukses
        return redirect()->route('admin.daftar_siswa.store')->with('success', 'Siswa baru berhasil ditambahkan!');
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
