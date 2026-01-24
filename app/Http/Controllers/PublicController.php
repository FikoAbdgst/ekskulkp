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
        $query = Siswa::query();

        // Search functionality
        if (request()->filled('search')) {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama_siswa', 'LIKE', "%{$search}%")
                    ->orWhere('nisn', 'LIKE', "%{$search}%")
                    ->orWhere('kelas', 'LIKE', "%{$search}%");
            });
        }

        // Filter by kelas
        if (request()->filled('kelas')) {
            $query->where('kelas', request('kelas'));
        }

        // Sorting
        $sortBy = request()->get('sort_by', 'created_at');
        $sortOrder = request()->get('sort_order', 'desc');

        if (in_array($sortBy, ['nama_siswa', 'nisn', 'kelas', 'created_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        // Pagination
        $perPage = request()->get('per_page', 10);
        $siswas = $query->paginate($perPage)->withQueryString();
        $kelasList = Siswa::distinct()->pluck('kelas')->sort();

        return view('welcome', compact('ekskuls', 'siswas', 'kelasList'));
    }

    public function checkSiswa(Request $request)
    {
        $request->validate([
            'nisn' => 'required',
            'nama' => 'required',
        ]);

        $siswa = Siswa::where('nisn', $request->nisn)->first();

        if (!$siswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'NISN tidak ditemukan dalam database sekolah.'
            ]);
        }

        if (strcasecmp($siswa->nama_siswa, $request->nama) != 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Nama tidak sesuai dengan NISN yang terdaftar.'
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
            'alasan' => 'required|string|max:255',
        ]);

        $siswa = Siswa::findOrFail($request->siswa_id);

        // Cek apakah sudah terdaftar
        if ($siswa->ekskuls()->where('ekskul_id', $request->ekskul_id)->exists()) {
            return back()->with('error', 'Kamu sudah terdaftar di ekskul ini sebelumnya!');
        }

        $siswa->ekskuls()->attach($request->ekskul_id, [
            'no_wa' => $request->no_wa,
            'alasan' => $request->alasan
        ]);

        // --- UPDATE PENTING ---
        // Kita kirim balik data 'verified_siswa' dan 'last_wa'
        // Agar View bisa langsung render Step 2 tanpa perlu login ulang
        return back()
            ->with('registration_success', 'Pendaftaran berhasil! Ingin daftar ekskul lain?')
            ->with('verified_siswa', $siswa)
            ->with('last_wa', $request->no_wa);
    }
}
