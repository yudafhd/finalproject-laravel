<?php

namespace App\Exports;

use App\OkpReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OkpExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return OkpReport::all();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Bidang',
            'Alamat',
            'Long',
            'Lat',
            'Tanggal Daftar',
            'No OKP',
            'Status',
            'Visi',
            'Misi',
            'Latar Belakang',
            'Tanggal Berdiri',
            'Pendiri',
        ];
    }
}