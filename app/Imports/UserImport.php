<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow
{
    protected $type;
    protected $kelas_id;

    public function __construct($type, $kelas_id)
    {
        $this->type = $type;
        $this->kelas_id = $kelas_id;
    }


    public function model(array $row)
    {
        if ($this->type == 'guru') {
            return new User([
                'name'     => $row['name'],
                'nip'     => $row['nip'],
                'email'     => $row['email'],
                'phone_number'     => $row['phone'],
                'address'     => $row['alamat'],
                'password'     =>  bcrypt($row['password']),
                'type'     => 'guru',
            ]);
        }

        if ($this->type == 'siswa') {
            return new User([
                'name'     => $row['name'],
                'nis'     => $row['nis'],
                'phone_number'     => $row['phone'],
                'parent_name'     => $row['parent_name'],
                'address'     => $row['alamat'],
                'kelas_id'     => $this->kelas_id,
                'password'     =>  bcrypt($row['password']),
                'type'     => 'siswa',
            ]);
        }
    }
}
