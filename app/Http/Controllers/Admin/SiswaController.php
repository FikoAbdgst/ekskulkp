<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil data siswa dengan pagination (10 per halaman)
        $siswas = Siswa::latest()->paginate(10);
        return view('admin.siswa.index', compact('siswas'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {
            Excel::import(new SiswaImport, $request->file('file'));
            return back()->with('success', 'Data siswa berhasil diimport/diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        // Fitur tambah manual (opsional jika admin ingin nambah satu-satu)
        $request->validate([
            'nama_siswa' => 'required',
            'nisn' => 'required|unique:siswas,nisn',
            'kelas' => 'required'
        ]);

        Siswa::create($request->all());
        return back()->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Siswa::findOrFail($id)->delete();
        return back()->with('success', 'Data siswa berhasil dihapus');
    }
}
