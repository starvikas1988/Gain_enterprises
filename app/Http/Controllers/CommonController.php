<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Driver;

use File;
use Session;
use Exception;
use Auth;
use Mail;
use DB;

class CommonController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
	
	public function selectCustomerSearch(Request $request)
    {
    	$customers = [];        
        $search = $request->q;
        $customers = User::Where('name', 'LIKE', "%$search%")->OrWhere('mobile', 'LIKE', "%$search%")->get(["id", "referral_code", "name", "email", "mobile"]);
        
        return response()->json($customers);
    }
	
	public function selectDriverSearch(Request $request)
    {
    	$drivers = [];
        if($request->has('q')){
            $search = $request->q;
            $drivers = Driver::Where('name', 'LIKE', "%$search%")->OrWhere('mobile', 'LIKE', "%$search%")->get(["id", "name", "mobile"]);
        }
        return response()->json($drivers);
    }
	
	public function get_balance(Request $request)
    {	
		$user_id = $request->id;
        $customers =User::Where('id',$user_id)->get(["balance"]);
		if($customers->isNotEmpty()){
			return $customers[0]->balance;
		} else {
			return 0;
		}
    }
		
	public function get_driver_balance(Request $request)
    {	
		$driver_id = $request->id;
        $drivers =Driver::Where('id',$driver_id)->get(["balance"]);
		if($drivers->isNotEmpty()){
			return $drivers[0]->balance;
		} else {
			return 0;
		}
    }

}
