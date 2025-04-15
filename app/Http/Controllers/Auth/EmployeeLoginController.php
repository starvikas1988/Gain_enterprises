<?php
namespace App\Http\Controllers\Auth;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmployeeLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.employeelogin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $employee = Employee::where('email', $request->email)->first();

        if (Auth::guard('employee')->attempt($request->only('email', 'password'), $request->remember)) {
            EmployeeAttendance::create([
                'employee_id' => $employee->id,
                'login_time' => now(),
            ]);
            return redirect()->route('employee.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        $employee = Auth::guard('employee')->user();
        $attendance = EmployeeAttendance::where('employee_id', $employee->id)
        ->whereDate('login_time', now()->toDateString())
        ->latest()
        ->first();

        if ($attendance && !$attendance->logout_time) {
            $attendance->update([
                'logout_time' => now(),
            ]);
        }
        Auth::guard('employee')->logout();
        return redirect()->route('employee.login');
    }
}


?>