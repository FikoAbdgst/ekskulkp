<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $ekskuls = Ekskul::all();
        return view('welcome', compact('ekskuls'));
    }

    // API untuk cek validitas siswa via AJAX
    public function checkSiswa(Request $request)
    {
        /*************  ✨ Windsurf Command ⭐  *************/
        /**
         * Import data siswa dari file Excel (.xlsx, .xls, .csv).
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\RedirectResponse
         *
         * @throws \Exception
         */
        /*******  cc02a89f-8d82-42c8-be87-532f750cdb48  *******/        $request->validate([
            'nisn' => 'required',
            'nama' => 'required',
            'kelas' => 'required'
        ]);

        // Cari siswa berdasarkan NISN
        $siswa = Siswa::where('nisn', $request->nisn)->first();

        if (!$siswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'NISN tidak ditemukan dalam database sekolah.'
            ]);
        }

        // Cek kesesuaian Nama (Case Insensitive)
        if (strcasecmp($siswa->nama_siswa, $request->nama) != 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Nama tidak sesuai dengan NISN yang terdaftar.'
            ]);
        }

        // Cek kesesuaian Kelas
        if ($siswa->kelas != $request->kelas) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kelas tidak sesuai dengan data siswa.'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data terverifikasi! Silakan pilih ekskul.',
            'siswa_id' => $siswa->id
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'ekskul_id' => 'required|exists:ekskuls,id',
            'no_wa' => 'required',
        ]);

        $siswa = Siswa::findOrFail($request->siswa_id);

        // Cek apakah sudah terdaftar di ekskul ini
        if ($siswa->ekskuls()->where('ekskul_id', $request->ekskul_id)->exists()) {
            return back()->with('error', 'Kamu sudah terdaftar di ekskul ini sebelumnya!');
        }

        // Daftar ekskul (attach ke pivot table)
        $siswa->ekskuls()->attach($request->ekskul_id, ['no_wa' => $request->no_wa]);

        return back()->with('success', 'Selamat! Kamu berhasil mendaftar ekskul.');
    }
}
