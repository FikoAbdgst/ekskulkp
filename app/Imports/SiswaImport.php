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
        // Pastikan header di Excel Anda adalah: 'nisn', 'nama', 'kelas'

        // 1. Validasi sederhana: jika nisn kosong, skip
        if (!isset($row['nisn']) || empty($row['nisn'])) {
            return null;
        }

        // 2. Simpan / Update data
        return Siswa::updateOrCreate(
            ['nisn' => $row['nisn']], // Cek berdasarkan NISN
            [
                'nama_siswa'    => $row['nama'],
                // Ambil kelas dari excel, jika kosong isi '-'
                'kelas'         => $row['kelas'] ?? '-',
            ]
        );
    }
}
