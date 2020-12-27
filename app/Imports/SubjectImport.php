<?php

namespace App\Imports;

use App\Subject;
use Maatwebsite\Excel\Concerns\ToModel;

class SubjectImport implements ToModel
{
    public function model(array $row)
    {
        return new Subject([
            'name'     => $row[0],
            'code'     => strtolower(trim($row[0]))
        ]);
    }
}
