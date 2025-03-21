<?php

namespace App\Http\Controllers\Restaurant;
use Auth;
use Hash;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:restaurant');
    }

    public function index()
    {
        $restaurantId = Auth::user()->id;
        $orderCount = Order::where('restaurant_id', $restaurantId)->count();
        // return view('restaurant.dashboard');
        return view('Restaurant.dashboard', compact('orderCount'));
    }

    public function myprofile()
    {
        $user = Restaurant::find(Auth::guard('restaurant')->id());
        return view('restaurant.myprofile')->with(['user' => $user]);
    }

    public function changepassword()
    {
        return view('restaurant.changepassword');
    }

    public function passwordchange(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $user = Auth::guard('restaurant')->user();

        if (!Hash::check($request->get('current_password'), $user->password)) {
            return redirect()->back()->withErrors("Your current password does not match.");
        }

        Restaurant::find($user->id)->update(['password' => Hash::make($request->new_password)]);
        return redirect()->back()->withSuccess('Password changed successfully');
    }

    public function updateprofile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'Name is required',
        ]);

        if ($validator->fails()) {
            return redirect(route('restaurant.myprofile'))->withErrors($validator)->withInput();
        }

        $restaurant = Restaurant::find(Auth::guard('restaurant')->id());
        $restaurant->name = $request->name;
        $restaurant->address = $request->address;
        $restaurant->save();

        return redirect(route('restaurant.myprofile'))->withSuccess('Profile updated successfully');
    }
}
