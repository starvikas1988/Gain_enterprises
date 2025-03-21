<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'numeric', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }
	
	public function customsignup(Request $request)
    {
      	$this->validate($request, [
			'mobile'   => 'required|unique:users',
			'email'   => 'nullable|unique:users',
			'name'  => 'required',
      	]); 
      	$user = new User;
      	$user->mobile = $request->mobile;
      	$user->name = $request->name;
      	$user->email = $request->email;
      	$user->status = 'A';
      	$user->mobile_verified = 1;
      	$user->password = Hash::make(12345678);
      	$user->save();          
      	Auth::login($user);
      	return response()->json(["status"=>true,"msg"=>"You have successfully login to access your dashboard","redirect_location"=>url()->previous()]);  
      
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mbl' => $data['mbl'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
