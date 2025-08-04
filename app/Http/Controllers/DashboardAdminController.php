<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\AbsensiGuru;
use App\Models\AbsensiMurid;
use App\Services\MoodleService; 
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    protected $moodle;

    public function __construct(MoodleService $moodle)
    {
        $this->moodle = $moodle;
    }

    public function index()
    {
        $totalGuru = User::whereHas('role', fn($q) => $q->where('name', 'Guru'))->count();
        $totalMurid = User::whereHas('role', fn($q) => $q->where('name', 'Siswa'))->count();
        $totalKelas = Kelas::count();
        $totalAbsensiGuru = AbsensiGuru::count();
        $totalAbsensiMurid = AbsensiMurid::count();

        // ✅ Ambil kursus dari Moodle
        $moodleCourses = $this->moodle->request('core_course_get_courses');

        // ✅ Ambil user dari Moodle
        $moodleUsers = $this->moodle->request('core_user_get_users', [
            'criteria' => [
                [
                    'key' => 'email',
                    'value' => '@' // semua user dengan email
                ]
            ]
        ]);

        return response()->json([
            'total_guru' => $totalGuru,
            'total_murid' => $totalMurid,
            'total_kelas' => $totalKelas,
            'total_absensi_guru' => $totalAbsensiGuru,
            'total_absensi_murid' => $totalAbsensiMurid,
            'moodle_courses' => $moodleCourses,
            'moodle_users' => $moodleUsers,
        ]);
    }

    // ✅ Tambah user ke Moodle (bisa dipanggil dari route khusus)
    public function createMoodleUser(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:8',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
        ]);

        $params = [
            'users' => [
                [
                    'username' => $data['username'],
                    'password' => $data['password'],
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'email' => $data['email'],
                    'auth' => 'manual',
                ]
            ]
        ];

        $response = $this->moodle->request('core_user_create_users', $params);

        return response()->json($response);
    }
}
