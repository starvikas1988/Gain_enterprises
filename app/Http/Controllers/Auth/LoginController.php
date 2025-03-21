<?php

namespace App\Http\Controllers\Auth;
use Socialite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	protected function validateLogin(Request $request)
	{
		if(is_numeric($request->get('email'))){
        	$user = User::where('mobile', '=', $request->get('email'))->first();
			if ($user) {
				if($user->status == 'P'){
					throw ValidationException::withMessages(['email' => __('The account is waiting for approval')]);
				}
				if($user->status == 'R'){
					throw ValidationException::withMessages(['email' => __('The account is rejected. Please contact to administrator')]);
				}
				if($user->status == 'D'){
					throw ValidationException::withMessages(['email' => __('The account is deactivated. Please contact to administrator')]);
				}
			}
			$request->validate([
				$this->username() => 'required|string',
				'password' => 'required|string',
			]);
        }
        elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
        	$user = User::where('email', '=', $request->get('email'))->first();
			if ($user) {
				if($user->status == 'P'){
					throw ValidationException::withMessages(['email' => __('The account is waiting for approval')]);
				}
				if($user->status == 'R'){
					throw ValidationException::withMessages(['email' => __('The account is rejected. Please contact to administrator')]);
				}
				if($user->status == 'D'){
					throw ValidationException::withMessages(['email' => __('The account is deactivated. Please contact to administrator')]);
				}
			}
			$request->validate([
				'email' => 'required',
				'password' => 'required|string',
			]);
        }		
	}
	
	public function customsignin(Request $request)
    {
      	$user = User::where('mobile', '=', $request->get('mobile'))->first();
		if ($user) {
			if($user->status == 'P'){
				throw ValidationException::withMessages(['mobile' => __('The account is waiting for approval')]);
			}
			if($user->status == 'R'){
				throw ValidationException::withMessages(['mobile' => __('The account is rejected. Please contact to administrator')]);
			}
			if($user->status == 'D'){
				throw ValidationException::withMessages(['mobile' => __('The account is deactivated. Please contact to administrator')]);
			}
		}       
      	Auth::login($user);
      	return response()->json(["status"=>true,"msg"=>"You have successfully login to access your dashboard","redirect_location"=>url()->previous()]);  
      
    }

	protected function credentials(Request $request)
    {
    	if(is_numeric($request->get('email'))){
        	return ['mobile'=>$request->get('email'),'password'=>$request->get('password'), 'status' => 'A'];
        }
        elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
        	return ['email' => $request->get('email'), 'password'=>$request->get('password'), 'status' => 'A'];
        }
        return ['email' => $request->get('email'), 'password'=>$request->get('password'), 'status' => 'A'];
    }
}