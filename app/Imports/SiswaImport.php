<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Pastikan nama kolom di Excel Anda: 'nisn', 'nama', 'kelas' (huruf kecil semua)
        // Logic: Update jika ada, Create jika belum ada
        return Siswa::updateOrCreate(
            ['nisn' => $row['nisn']], // Kunci pencarian (NISN)
            [
                'nama_siswa'    => $row['nama'], // Update nama
                'kelas'         => $row['kelas'], // Update kelas
            ]
        );
    }
}
