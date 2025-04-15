<?php

namespace App\Exports;

use App\Models\EmployeeAttendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EmployeeAttendance::with('employee')->get()->map(function($attendance) {
            return [
                'Employee Name' => $attendance->employee->name ?? 'N/A',
                'Login Time' => $attendance->login_time,
                'Logout Time' => $attendance->logout_time,
            ];
        });
        //return EmployeeAttendance::all();
    }

    public function headings(): array
    {
        return [
            'Employee Name',
            'Login Time',
            'Logout Time',
        ];
    }
}
