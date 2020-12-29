<?php

namespace App\Imports;

use App\Subject;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubjectImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Subject([
            'name'     => $row['name'],
            'code'     => $row['code'] ? $row['code'] : strtolower(trim($row['name']))
        ]);
    }
}
