<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeAttendance;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AttendanceExport;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = EmployeeAttendance::with('employee')->latest()->paginate(10);
        return view('admin.attendance.index', compact('attendances'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('admin.attendance.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'login_time' => 'required|date',
        ]);

        EmployeeAttendance::create($request->all());
        return redirect()->route('admin.attendance.index')->with('success', 'Attendance recorded.');
    }

    public function edit($id)
    {
        $attendance = EmployeeAttendance::findOrFail($id);
        $employees = Employee::all();
        return view('admin.attendance.edit', compact('attendance', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $attendance = EmployeeAttendance::findOrFail($id);
        $attendance->update($request->all());
        return redirect()->route('admin.attendance.index')->with('success', 'Attendance updated.');
    }

    public function destroy($id)
    {
        EmployeeAttendance::destroy($id);
        return back()->with('success', 'Attendance deleted.');
    }

    public function export()
    {
        return Excel::download(new AttendanceExport, 'attendance_report.xlsx');
    }
}
