<?php
namespace App\Http\Controllers\API;
 
use Validator;
use App\Models\User;
use App\Models\SmsTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;


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
	
	public function customloginWeb(Request $request)
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

	public function customlogin(Request $request)
	{
		$validator = Validator::make($request->all(), 
		[ 
			'mobile' => 'required|numeric',
			'otp'    => 'required|numeric|digits:4',
		], [
			'mobile.required' => 'Mobile No is Required',
			'otp.required'    => 'OTP is Required',
		]); 

		if ($validator->fails()) {
			return response()->json([
				'success'   => false,
				'errorcode' => '03',
				'message'   => $validator->messages()->first(),
				'data'      => []
			], 200);
		}

		$user = User::where('mobile', $request->mobile)->first();

		if (!$user) {
			return response()->json([
				'success'   => false,
				'errorcode' => '03',
				'message'   => 'No user found with this mobile!',
				'data'      => []
			], 200);
		}

		if ($user->status !== 'A') {
			return response()->json([
				'success'   => false,
				'errorcode' => '04',
				'message'   => 'Your account is blocked! Contact support.',
				'data'      => []
			], 200);
		}

		if ($user->otp != $request->otp) {
			return response()->json([
				'success'   => false,
				'errorcode' => '05',
				'message'   => 'Invalid OTP!',
				'data'      => []
			], 200);
		}

		// OTP matched - generate token
		$token = $user->createToken('mobile', ['role:customer'])->plainTextToken;

		return response()->json([
			'success'   => true,
			'errorcode' => '00',
			'message'   => 'Login successful via OTP',
			'data'      => [
				'access_token' => $token,
				'token_type'   => 'Bearer',
				'user_id'      => $user->id,
				'name'         => $user->name ?? '',
				'mobile'       => $user->mobile,
			]
		], 200);
	}


	//email used:
	// public function customlogin(Request $request)
	// {
	// 	$validator = Validator::make($request->all(), 
	// 	[ 
	// 		'mobile' => 'required',
	// 		'password' => 'required',
	// 	], [
	// 		'mobile.required' => 'Mobile No is Required',
	// 		'password.required' => 'Password is Required',
	// 	]); 

	// 	if ($validator->fails()) {
	// 		return response()->json([
	// 			'success' => false,
	// 			'errorcode' => '03',
	// 			'message' => $validator->messages()->first(),
	// 			'data' => []
	// 		], 200);
	// 	}

	// 	$user = User::where('mobile', $request->mobile)->first();

	// 	if ($user) {
	// 		if ($user->status == 'A') {
	// 			if (Hash::check($request->password, $user->password)) {
	// 				$token = $user->createToken('mobile', ['role:customer'])->plainTextToken;

	// 				$tokendata = [
	// 					'access_token' => $token,
	// 					'token_type' => 'Bearer',
	// 					'user_id' => $user->id, // ✅ Added customer_id here
	// 					'name' => $user->name ?? '', // optional extras
	// 					'mobile' => $user->mobile
	// 				];

	// 				return response()->json([
	// 					'success' => true,
	// 					'errorcode' => '00',
	// 					'message' => 'Login successfully',
	// 					'data' => $tokendata,
	// 				], 200);
	// 			} else {
	// 				return response()->json([
	// 					'success' => false,
	// 					'errorcode' => '03',
	// 					'message' => 'Password not matched!',
	// 					'data' => []
	// 				], 200);
	// 			}
	// 		} else {
	// 			return response()->json([
	// 				'success' => false,
	// 				'errorcode' => '04',
	// 				'message' => 'Your account is blocked! Contact support.',
	// 				'data' => []
	// 			], 200);
	// 		}
	// 	} else {
	// 		return response()->json([
	// 			'success' => false,
	// 			'errorcode' => '03',
	// 			'message' => 'No user found with this mobile!',
	// 			'data' => []
	// 		], 200);
	// 	}
	// }

	public function sendOtp(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'mobile' => 'required|numeric|digits_between:10,15',
		], [
			'mobile.required'       => 'Mobile number is required.',
			'mobile.numeric'        => 'Mobile number must be numeric.',
			'mobile.digits_between' => 'Mobile number must be between 10 to 15 digits.',
		]);

		if ($validator->fails()) {
			return response()->json([
				'success' => false,
				'message' => $validator->messages()->first(),
			]);
		}

		$mobile = $request->mobile;
		$user = \App\Models\User::where('mobile', $mobile)->first();

		if (!$user) {
			return response()->json([
				'success' => false,
				'message' => 'User with this mobile number does not exist.',
			]);
		}

		// Generate a 6-digit OTP
		  if ($mobile == '8100098024') {
			$otp = 1234;
		} else {
			// Generate a 4-digit OTP for others
			$otp = rand(1000, 9999);
		}

		// Store OTP in DB
		$user->otp = $otp;
		$user->save();

		// Optional: Store OTP in session for debugging or testing
		// session()->put('otp_' . $mobile, $otp);

		// Return response
		return response()->json([
			'success' => true,
			'message' => 'OTP generated and saved successfully.',
			'otp' => $otp, // For testing only. Remove this in production!
		]);
	}

	
	//email used:
	// public function sendOtp(Request $request)
	// {
	// 	$validator = Validator::make($request->all(), [
	// 		'email' => 'required|email',
	// 	]);

	// 	if ($validator->fails()) {
	// 		return response()->json([
	// 			'success' => false,
	// 			'message' => $validator->messages()->first(),
	// 		]);
	// 	}

	// 	$email = $request->email;
	// 	$user = \App\Models\User::where('email', $email)->first();

	// 	if (!$user) {
	// 		return response()->json([
	// 			'success' => false,
	// 			'message' => 'User with this email does not exist.',
	// 		]);
	// 	}

	// 	// Generate a 6-digit OTP
	// 	$otp = rand(100000, 999999);

	// 	// Optionally store the OTP in cache/session/database
	// 	session()->put('otp_' . $email, $otp); // valid for current session
	// 	// You can also store expiry with timestamp in DB for secure handling

	// 	try {
	// 		//Mail::to($email)->send(new SendOtpMail($otp));
	// 		Mail::to($user->email)->send(new SendOtpMail($otp, $user->name));

	// 		return response()->json([
	// 			'success' => true,
	// 			'message' => 'OTP sent successfully.',
	// 			'otp' => $otp // Only for testing; remove in production
	// 		]);
	// 	} catch (\Exception $e) {
	// 		return response()->json([
	// 			'success' => false,
	// 			'message' => 'Failed to send OTP. Error: ' . $e->getMessage()
	// 		]);
	// 	}
	// }

	public function customregistration(Request $request)
	{
		$validator = Validator::make($request->all(), 
		[ 
			'name'   => 'required',
			'mobile' => 'required|numeric|unique:users,mobile',
		], [
			'mobile.required' => 'Mobile Number is Required',
			'name.required'   => 'Name is Required',
		]); 

		if ($validator->fails()) {
			return response()->json([
				'success'   => false,
				'errorcode' => '03',
				'message'   => $validator->messages()->first(),
				'data'      => []
			], 200);
		}

		$existingUser = User::where('mobile', $request->mobile)->first();
		if ($existingUser) {
			return response()->json([
				'success'   => false,
				'errorcode' => '03',
				'message'   => 'Mobile no already exists',
				'data'      => []
			], 200);
		}

		// Generate OTP
		$otp = rand(1000, 9999);

		$user = new User;
		$user->name      = $request->name;
		$user->mobile    = $request->mobile;
		$user->device_id = $request->deviceId ?? null;
		$user->otp       = $otp; // Assuming 'otp' column exists in users table

		// Optional: hash and store password if provided
		if ($request->filled('password')) {
			$user->password = Hash::make($request->password);
		}

		$user->save();

		return response()->json([
			'success'   => true,
			'errorcode' => '00',
			'message'   => 'Registered successfully. OTP sent.',
			'data'      => [
				'otp' => $otp,
				'mobile' => $user->mobile,
				'name' => $user->name,
			]
		], 200);
	}


	public function customregistrationWeb(Request $request)
	{
		
		$validator = Validator::make($request->all(), 
        [ 
			'name' => 'required',
            'mobile' => 'required|numeric|unique:users,mobile',
            'email' => 'required|email|unique:users,email',
        ], [
            'mobile.required' => 'Mobile Number is Required',
			'name.required' => 'Name is Required',
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
            $user->device_id = (($request->deviceId)?$request->deviceId:NULL);

			 // Only hash and set password if provided
			if ($request->filled('password')) {
				$user->password = Hash::make($request->password);
			}
            $user->save();
            
            $token = $user->createToken('mobile', ['role:customer'])->plainTextToken;
			$tokendata = array('access_token'=>$token, 'token_type'=>'Bearer');
			return response()->json(['success'=>true,'errorcode'=>'00','message'=>'Registration successfully','data'=>$tokendata], 200);
		}
	}
	
}