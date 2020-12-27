<?php

namespace App\Exports;

use App\Schedule;
use Maatwebsite\Excel\Concerns\FromCollection;

class ScheduleExport implements FromCollection
{
    public function collection()
    {
        return Schedule::all();
    }
}
