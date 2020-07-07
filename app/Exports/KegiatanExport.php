<?php

namespace App\Exports;

use App\KegiatanExport as Kegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KegiatanExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kegiatan::all();
    }

    public function headings(): array
    {
        return [
            'Judul',
            'Detail Kegiatan',
            'Detail Anggaran',
            'Tanggal Terlaksana',
            'Sasaran',
            'Tujuan',
            'Hasil',
            'Tempat'
        ];
    }
}