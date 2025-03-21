<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Auth;
use Route;

class RestaurantLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:restaurant')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.restaurantlogin');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('restaurant')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('restaurant.dashboard'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['error' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('restaurant')->logout();
        return redirect('/restaurant/login');
    }
}

