<?php

namespace App\Exports;

use App\Absent;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsentExport implements FromCollection, WithHeadings
{
    protected $start;
    protected $end;

    public function __construct($start_at, $end_at)
    {
        $this->start = $start_at;
        $this->end = $end_at;
    }

    public function headings(): array
    {
        return [
            'NIS',
            'NAMA',
            'JURUSAN',
            'KELAS',
            'NOMOR',
            'ALASAN',
            'TANGGAL',
        ];
    }

    public function collection()
    {
        return collect(
            DB::select(
                DB::raw('select nis, users.name, majors, grade, number, reason, date_absent 
                        from `absents` 
                        inner join `users` on `users`.`id` = `absents`.`user_id` 
                        inner join `kelas` on `kelas`.`id` = `users`.`kelas_id` 
                        where `absents`.`deleted_at` is null
                        and `absents`.`created_at` between "' . $this->start . '" and "' . $this->end . '" 
                        group by nis, users.name, majors, grade, number, date_absent, reason 
                        order by users.name, majors, grade, number, date_absent')
            )
        );

        // return DB::table('absents')
        //     ->join('users', 'users.id', '=', 'absents.user_id')
        //     ->join('kelas', 'kelas.id', '=', 'users.kelas_id')
        //     ->join('schedules', 'schedules.id', '=', 'absent.schedule_id')
        //     ->join('subjects', 'subjects.id', '=', 'schedules.subject_id')
        //     ->select(['sum(date_absent) as total'])
        //     ->whereNull('absents.deleted_at')
        //     ->groupBy(['nis', 'name', 'majors', 'grade', 'number', 'date_absent', 'reason'])
        //     ->get(['nis', 'name', 'majors', 'grade', 'number', 'date_absent', 'reason']);
        // return Absent::with(['users'])->whereBetween('created_at', [$this->start, $this->end])->get(['name']);
    }
}
