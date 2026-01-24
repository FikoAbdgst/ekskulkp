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

        // Tambahkan data siswa dan kelas untuk halaman welcome
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

        // Pagination with per_page option
        $perPage = request()->get('per_page', 10);
        $siswas = $query->paginate($perPage)->withQueryString();

        // Get unique kelas for filter dropdown
        $kelasList = Siswa::distinct()->pluck('kelas')->sort();

        return view('welcome', compact('ekskuls', 'siswas', 'kelasList'));
    }

    // API untuk cek validitas siswa via AJAX
    public function checkSiswa(Request $request)
    {
        // Validasi input (Kelas dihapus)
        $request->validate([
            'nisn' => 'required',
            'nama' => 'required',
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

        // --- BAGIAN CEK KELAS DIHAPUS ---
        // Verifikasi hanya membutuhkan NISN dan Nama yang cocok

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
