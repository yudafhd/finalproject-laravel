<?php

namespace App\Imports;

use App\Kelas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KelasImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Kelas([
            'majors'     => $row['jurusan'],
            'grade'     => $row['kelas'],
            'number'     => $row['nomor']
        ]);
    }
}
