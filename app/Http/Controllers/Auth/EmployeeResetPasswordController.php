<?php

namespace App\Http\Controllers\Auth;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class EmployeeResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.employee.passwords.reset')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function reset(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:8',
    ]);

    // Debugging: Check if the employee exists
    $employee = Employee::where('email', $request->email)->first();
    if (!$employee) {
        return back()->withErrors(['email' => 'No employee found with this email.']);
    }
   // dd(Employee::where('email', $request->email)->first());

    // Reset password
    $status = Password::broker('employees')->reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('employee.login')->with('status', __('Password reset successfully!'))
        : back()->withErrors(['email' => __('Password reset failed. Please try again.')]);
}


    
}
