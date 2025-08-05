<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\AbsensiGuru;
use App\Models\Admin;
use App\Models\User;

use Illuminate\Http\Request;

class AdminAbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tanggal = now()->format('Y-m-d');
        $guru = User::where('role_id', 2)->get(); // role guru

        return view('admin.absensi_admin.index', compact('guru', 'tanggal'));
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
        foreach ($request->absensi as $user_id => $status) {
            Absensi::updateOrCreate(
                ['user_id' => $user_id, 'tanggal' => $request->tanggal],
                ['status' => $status]
            );
        }

        return redirect()->back()->with('success', 'Absensi berhasil disimpan');
    }

    public function rekap()
    {
        $data = Absensi::with('user')->orderBy('tanggal', 'desc')->get();
        return view('admin.absensi_admin.rekap', compact('data'));
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
