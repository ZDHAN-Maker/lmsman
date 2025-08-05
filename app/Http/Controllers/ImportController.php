<?php

namespace App\Http\Controllers;

use App\Imports\GuruImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function showForm()
    {
        return view('import.form');
    }

    public function importGuru(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new GuruImport, $request->file('file'));

        return back()->with('success', 'Data guru berhasil diimpor.');
    }
}
