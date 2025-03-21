<?php
namespace App\Http\Controllers\API;
 
use Validator;
use App\Models\User;
use App\Models\SmsTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;

use Laravel\Sanctum\HasApiTokens; 

use DB;

class CustomerAuthController extends Controller
{
    public $token = true;  
	
	public function __construct()
    {
        
    }
	
	public function customlogin(Request $request)
	{
		$validator = Validator::make($request->all(), 
        [ 
            'mobile' => 'required',
			'password' => 'required',
        ], [
            'mobile.required' => 'Mobile No is Required',
			'password.required' => 'Password is Required',
        ]); 
        if($validator->fails()){
            return response()->json(['success'=>false,'errorcode'=>'03','message'=>$validator->messages()->first(),'data'=>array()], 200);
        }		
		$user = User::where('mobile', $request->mobile)->first();
		if($user)
		{
			if($user->status=='A')
			{
		        if(Hash::check($request->password, $user->password))
		        {
					$token = $user->createToken('mobile', ['role:customer'])->plainTextToken;
					$tokendata = array('access_token'=>$token, 'token_type'=>'Bearer');
					return response()->json(['success'=>true,'errorcode'=>'00', 'message'=>'login successfully','data'=>$tokendata], 200);
		        }
		        else
		           return response()->json(['success'=>false,'errorcode'=>'03','message'=>'Password not matched!','data'=>array()], 200);
			} 
			else 
				return response()->json(['success'=>false,'errorcode'=>'04', 'message'=>'Your account is blocked! contact to support.','data'=>array()], 200);
		}
		else 
			return response()->json(['success'=>false,'errorcode'=>'03','message'=>'No user found with this mobile!','data'=>array()], 200);
	}
	
	public function customregistration(Request $request)
	{
		$validator = Validator::make($request->all(), 
        [ 
			'name' => 'required',
            'mobile' => 'required|numeric|unique:users,mobile',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ], [
            'mobile.required' => 'Mobile Number is Required',
			'name.required' => 'Name is Required',
			'password.required' => 'Password is Required',
        ]); 
        if($validator->fails()){
            return response()->json(['success'=>false,'errorcode'=>'03','message'=>$validator->messages()->first(),'data'=>array()], 200);
        }		
		$user = User::where('mobile', $request->mobile)->first();
		if($user)
		{
			return response()->json(['success'=>false,'errorcode'=>'03','message'=>'Mobile no already exist','data'=>array()], 200);
		} 
		else 
		{
		    $user = new User;
            $user->name = $request->name;
            $user->email = (($request->email)?Str::lower($request->email):NULL);
            $user->mobile = $request->mobile;
            $user->password = Hash::make($request->password);
            $user->device_id = (($request->deviceId)?$request->deviceId:NULL);
            $user->save();
            
            $token = $user->createToken('mobile', ['role:customer'])->plainTextToken;
			$tokendata = array('access_token'=>$token, 'token_type'=>'Bearer');
			return response()->json(['success'=>true,'errorcode'=>'00','message'=>'Registration successfully','data'=>$tokendata], 200);
		}
	}
	
}