<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::query();

        // LOGIKA SEARCH DIPERBAIKI
        if ($request->filled('search')) {
            // Apa pun yang diketik user, kita ubah jadi KAPITAL agar cocok dengan database
            $search = strtoupper($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('nama_siswa', 'LIKE', "%{$search}%") // Nama biasanya aman dengan LIKE
                    ->orWhere('nisn', 'LIKE', "%{$search}%")
                    ->orWhere('kelas', 'LIKE', "%{$search}%"); // Sekarang 'x rpl 1' akan cocok dengan 'X RPL 1'
            });
        }

        // LOGIKA FILTER KELAS
        if ($request->filled('kelas')) {
            // Filter dropdown juga kita paksa jadi kapital
            $query->where('kelas', strtoupper($request->kelas));
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        if (in_array($sortBy, ['nama_siswa', 'nisn', 'kelas', 'created_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        // Pagination with per_page option
        $perPage = $request->get('per_page', 10);

        // UBAH BARIS INI:
        // Tambahkan .withCount('ekskuls') sebelum paginate
        $siswas = $query->withCount('ekskuls')->paginate($perPage)->withQueryString();

        // Get unique kelas for filter dropdown
        $kelasList = Siswa::distinct()->pluck('kelas')->sort();

        return view('admin.siswa.index', compact('siswas', 'kelasList'));
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
        $request->validate([
            'nama_siswa' => 'required',
            'nisn' => 'required|unique:siswas,nisn',
            'kelas' => 'required'
        ]);

        // UBAH LOGIKA PENYIMPANAN:
        // Jangan langsung $request->all(), tapi manipulasi dulu kelasnya
        $data = $request->all();
        $data['kelas'] = strtoupper($request->kelas); // Paksa jadi huruf besar

        Siswa::create($data); //
        return back()->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Siswa::findOrFail($id)->delete();
        return back()->with('success', 'Data siswa berhasil dihapus');
    }

    public function downloadTemplate()
    {
        $data = [
            ['nisn', 'nama', 'kelas'],
            ['1234567890', 'Contoh Siswa', 'X RPL 1']
        ];

        return Excel::download(new class($data) implements \Maatwebsite\Excel\Concerns\FromArray {
            protected $data;
            public function __construct(array $data)
            {
                $this->data = $data;
            }
            public function array(): array
            {
                return $this->data;
            }
        }, 'template_siswa.xlsx');
    }
}
