<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
class RestaurantResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.restaurant.passwords.reset')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function reset(Request $request)
    {
        // Validate input
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);
       // dd($request->all());
        // Reset password using the restaurants broker
        $status = Password::broker('restaurants')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password); // Secure password hashing
                $user->save();
            }
        );

        // Redirect with success or error message
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('restaurant.login')->with('status', __('Password reset successfully!'))
            : back()->withErrors(['email' => __('Password reset failed. Please try again.')]);
    }

    // public function reset(Request $request)
    // {
    //     $request->validate([
    //         'token' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required|confirmed|min:8',
    //     ]);

    //     $status = Password::broker('restaurants')->reset(
    //         $request->only('email', 'password', 'password_confirmation', 'token'),
    //         function ($user, $password) {
    //             $user->password = bcrypt($password);
    //             $user->save();
    //         }
    //     );

    //     return $status === Password::PASSWORD_RESET
    //         ? redirect()->route('restaurant.login')->with('status', __($status))
    //         : back()->withErrors(['email' => [__($status)]]);
    // }

    
}
