<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ekskul;
use App\Models\Registrant;

class EkskulController extends Controller
{
    /**
     * Menampilkan Dashboard Admin
     */
    public function index()
    {
        // 1. Ambil data pendaftar beserta relasi ekskul yang dipilih
        // 'with' digunakan agar query lebih ringan (eager loading)
        // 'latest' agar pendaftar terbaru muncul di atas
        $registrants = Registrant::with('ekskul')->latest()->get();

        // 2. Kirim data tersebut ke view 'home'
        return view('home', compact('registrants'));
    }

    /**
     * Menyimpan Data Ekskul Baru
     */
    public function store(Request $request)
    {
        // Validasi input admin
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jadwal' => 'required|string',
        ]);

        // Simpan ke database
        Ekskul::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'jadwal' => $request->jadwal,
            // Jika ingin menambahkan gambar default atau null
            'gambar' => null
        ]);

        // Kembali ke halaman dashboard dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('status', 'Ekskul berhasil ditambahkan!');
    }
}
