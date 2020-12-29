<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    protected $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function headings(): array
    {
        if ($this->type == 'guru') {
            return [
                'NIP',
                'NAMA',
                'PHONE',
                'ALAMAT',
            ];
        }
        if ($this->type == 'siswa') {
            return [
                'NIS',
                'NAMA',
                'ORANG TUA',
                'TELEPHONE',
                'ALAMAT'
            ];
        }
        return [];
    }

    public function collection()
    {
        if ($this->type == 'guru') {
            return User::where('type', 'guru')->get(['NIP', 'name', 'phone_number', 'address']);
        }

        if ($this->type == 'siswa') {
            return User::where('type', 'siswa')->get(['NIS', 'name', 'parent_name', 'phone_number', 'address']);
        }

        return User::all();
    }
}
