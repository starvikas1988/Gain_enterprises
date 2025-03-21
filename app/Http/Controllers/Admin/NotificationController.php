<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Notification;
use App\Models\User;
use App\Models\Vendor;
use File;
use Auth;
use DB;

class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->can(request()->segment(2))){
                return $next($request);
            }
            abort(403);
        });
    }

    /**
     * show dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->ajax())
            return view('admin.notification.header',['title'=>'Notification list']);
        else
        {
            $limit = 100;
            $serial[] = (request()->input('page')==0)?1:(($limit*(request()->input('page')-1))+1);
            $query = Notification::where('id','>','0');
            // Search Start
            if($request->input('skey')!=''){
                $query = $query->where('title','LIKE','%'.$request->input('skey').'%');
            }
           /* if($request->input('sstat')!='')
                $query = $query->where('row_status','=', $request->input('sstat'));

            if($request->input('sdate')!='')
                $query = $query->whereDate('created_at','=', $request->input('sdate'));*/
            // Search End
            $count = $query->count();
            $result = $query->orderBy('id','DESC')->paginate($limit);
            return view('admin.notification.table',['serial'=>$serial,'count'=>$count,'result'=>$result]);
        }
    }

    
    public function create()
    {		
        return view('admin.notification.create');
    }

    
    public function store(Request $request)
    {
        $sValidationRules = [
            'membertype' => 'required',
            'title' => 'required',
            'message' => 'required',
        ];
        $validator = Validator::make($request->all(), $sValidationRules);
        if ($validator->fails()) // on validator found any error 
        {
            return redirect(route('admin.notification.create'))->withErrors($validator)->withInput();
        }        
		
		if($request->membertype=='Customer')
		{
			$admin = New Notification;
			$admin->title = $request->title;
			$admin->notification_type = $request->membertype;
			$admin->message = $request->message;
			if(isset($request->suser)){
				$admin->user_id = implode(',',$request->suser);
			}
			if($request->hasFile('userfile')){
				$image = rand().time().'.'.$request->userfile->extension();
				$request->userfile->move(public_path('uploads/notification'), $image);
				$admin->image = 'public/uploads/notification/'.$image;
			}
			$admin->save();
			if(isset($request->suser)){
				$firebaseToken = User::whereNotNull('device_id')->WhereIn('id',$request->suser)->pluck('device_id')->all(); 	
			} else {
				$firebaseToken = User::whereNotNull('device_id')->pluck('device_id')->all();
			}	
		} 
		else 
		{
			$admin = New Notification;
			$admin->title = $request->title;
			$admin->notification_type = $request->membertype;
			$admin->message = $request->message;
			if(isset($request->svendor)){
				$admin->vendor_id = implode(',',$request->svendor);
			}
			if($request->hasFile('userfile')){
				$image = rand().time().'.'.$request->userfile->extension();
				$request->userfile->move(public_path('uploads/notification'), $image);
				$admin->image = 'public/uploads/notification/'.$image;
			}
			$admin->save();
			if(isset($request->svendor)){
				$firebaseToken = User::whereNotNull('device_id')->WhereIn('id',$request->svendor)->pluck('device_id')->all(); 	
			} else {
				$firebaseToken = User::whereNotNull('device_id')->pluck('device_id')->all();
			}
		}               
		if($firebaseToken)
		{
			$SERVER_API_KEY = env('FCM_SERVER_KEY');    
			if($request->hasFile('userfile')){
				$data = [
					"registration_ids" => $firebaseToken,
					"notification" => [
						"title" => $request->title,
						"body" => $request->message,  
						"sound" => "Enabled",
						"image"	=> asset('public/uploads/notification/'.$image),
					]
				];
			} else {
				$data = [
					"registration_ids" => $firebaseToken,
					"notification" => [
						"title" => $request->title,
						"body" => $request->message,  
						"sound" => "Enabled",
					]
				];
			}
			
			$dataString = json_encode($data);      
			$headers = [
				'Authorization: key=' . $SERVER_API_KEY,
				'Content-Type: application/json',
			];      
			$ch = curl_init();        
			curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);                 
			curl_exec($ch);
		}		
        return redirect(route('admin.notifications'))->withSuccess('Added successfully');
    }
      
    public function destroy(Request $request)
    {
        Notification::where('id', '=', $request->id)->delete();
        return redirect(route('admin.notifications'))->withSuccess('Deleted successfully');
    }
}
