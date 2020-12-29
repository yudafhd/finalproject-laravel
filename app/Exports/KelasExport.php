<?php

namespace App\Exports;

use App\Kelas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KelasExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'JURUSAN',
            'KELAS',
            'NOMOR',
        ];
    }

    public function collection()
    {
        return Kelas::all(['majors', 'grade', 'number']);
    }
}
