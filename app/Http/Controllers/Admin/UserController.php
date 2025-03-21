<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\User;
use File;
use Auth;
use DB;
use Hash;


class UserController extends Controller
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
    public function index(Request $request)
    {
        if(!$request->ajax())
            return view('admin.user.header',['title'=>'User list']);
        else
        {
            $limit = 10;
            $serial[] = (request()->input('page')==0)?1:(($limit*(request()->input('page')-1))+1);
            $query = User::where('id','>','0');
            // Search Start
            if($request->input('skey')!=''){
                $query = $query->where('name','LIKE','%'.$request->input('skey').'%');                
                $query = $query->orWhere('mobile','LIKE','%'.$request->input('skey').'%');
                $query = $query->orWhere('email','LIKE','%'.$request->input('skey').'%');
            }
            if($request->input('sstat')!=''){
                $query = $query->where('status','=', $request->input('sstat'));
			}           
            if($request->input('sdate')!=''){
                $query = $query->whereDate('created_at','=', $request->input('sdate'));
			}
            $count = $query->count();
            $result = $query->orderBy('id','DESC')->paginate($limit);
            return view('admin.user.table',['serial'=>$serial,'count'=>$count,'result'=>$result]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [ 
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric|unique:users,mobile',
        ], [
            'mobile.required' => 'Mobile Number is Required',
            'mobile.unique' => 'Mobile Number was already registered',
            'address.required' => 'Address is required',
            'email.email' => 'The email format is wrong – please enter a valid email address',
        ]);  
        if ($validator->fails()) // on validator found any error 
        {
            return redirect(route('admin.user.create'))->withErrors($validator)->withInput();
        }  
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->save();
        return redirect(route('admin.users'))->withSuccess('Added successfully');       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$user = User::Where('id','=',$id)->first();
		$user_add = Useraddress::Where('uid','=',$id)->get();
		
        return view('admin.user.show',['user'=>$user,'address'=>$user_add]);
    }
    public function edit(Request $request)
    {
        $user = User::Where('id','=',$request->id)->get();
        return view('admin.user.edit',['user'=>$user]);
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [ 
            'name' => 'required',
            'email' => 'required|email',    
            'mobile' => 'required|numeric|unique:users,mobile,'.$request->id,
        ], [
            'mobile.required' => 'Mobile Number is Required',
            'mobile.unique' => 'Mobile Number was all ready registered',            
            'email.email' => 'The email format is wrong – please enter a valid email address',
        ]);  
        if ($validator->fails()) // on validator found any error 
        {
            return redirect(route('admin.user.edit',['id'=>$request->id]))->withErrors($validator)->withInput();
        }
        $user = User::find($request->id);
		$user->name = $request->name;
		$user->mobile = $request->mobile;
		$user->email = strtolower($request->email);
		$user->status = $request->status;		
        $user->save();
        return redirect(route('admin.users'))->withSuccess('Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $admin = User::find($request->id);
        User::where('id', '=', $request->id)->delete();
        return redirect(route('admin.users'))->withSuccess('Deleted successfully');
    }
}
