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
            ['nisn' => $row['nisn']],
            [
                'nama_siswa'    => $row['nama'],
                'kelas'         => strtoupper($row['kelas'] ?? '-'),
            ]
        );
    }
}
