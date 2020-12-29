<?php

namespace App\Exports;

use App\Subject;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SubjectExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'NAME',
            'CODE',
        ];
    }

    public function collection()
    {
        return Subject::all(['name', 'code']);
    }
}
