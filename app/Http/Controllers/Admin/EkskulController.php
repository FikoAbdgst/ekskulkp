<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ekskul;
use App\Models\Registrant;

class EkskulController extends Controller
{
    public function index()
    {
        // Mengambil semua data ekskul
        // Kita keyBy('id') agar nanti di JS mudah diambil berdasarkan ID
        $ekskuls = Ekskul::all();
        return view('admin.ekskul.index', compact('ekskuls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'penanggung_jawab' => 'required', // <--- Tambahkan ini
            'deskripsi' => 'required',
            'icon' => 'required',
            'warna' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        Ekskul::create($request->all());
        return back()->with('success', 'Ekskul berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $ekskul = Ekskul::findOrFail($id);
        $request->validate([
            'nama' => 'required',
            'penanggung_jawab' => 'required', // <--- Tambahkan ini
            'deskripsi' => 'required',
            'icon' => 'required',
            'warna' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $ekskul->update($request->all());
        return redirect()->route('admin.ekskul.index')->with('success', 'Ekskul berhasil diupdate!');
    }

    public function destroy($id)
    {
        Ekskul::findOrFail($id)->delete();
        return back()->with('success', 'Ekskul berhasil dihapus!');
    }
    public function show($id)
    {
        $ekskul = Ekskul::with('registrants')->findOrFail($id);
        return view('admin.ekskul.show', compact('ekskul'));
    }

    public function removeSiswa($ekskulId, $siswaId)
    {
        $siswa = Registrant::where('id', $siswaId)
            ->where('ekskul_id', $ekskulId)
            ->firstOrFail();

        $siswa->delete();

        return back()->with('success', 'Siswa berhasil dihapus dari ekskul!');
    }
}
