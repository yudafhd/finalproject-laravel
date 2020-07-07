<?php

namespace App\Exports;

use App\AnggotaExport as Anggota;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AnggotaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Anggota::all();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Jabatan',
            'Tanggal Masuk',
            'Alamat',
        ];
    }
}