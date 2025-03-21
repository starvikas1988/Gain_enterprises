<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Role;
use App\Models\Permission;
use App\Models\Mainpermission;
use App\Models\Rolepermission;
use Auth;
use DB;

class RoleController extends Controller
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
            return view('admin.role.header',['title'=>'Role list']);
        else
        {
            $limit = 10;
            $serial[] = (request()->input('page')==0)?1:(($limit*(request()->input('page')-1))+1);
            $query = Role::where('id','>','0');
            // Search Start
            if($request->input('skey')!=''){
                $query = $query->where('name','LIKE','%'.$request->input('skey').'%');
            }
            
            $count = $query->count();
            $result = $query->orderBy('id','DESC')->paginate($limit);
            return view('admin.role.table',['serial'=>$serial,'count'=>$count,'result'=>$result]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::Where('status','=','Active')->get();
        return view('admin.role.create',['role'=>$role]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sValidationRules = [
            'name' => 'required',
        ];
        $validator = Validator::make($request->all(), $sValidationRules);
        if ($validator->fails()) // on validator found any error 
        {
            return redirect(route('admin.role.create'))->withErrors($validator)->withInput();
        }
        $admin = New Role;
        $admin->name = $request->name;
        $admin->slug = $request->slug;
        $admin->save();
        
        return redirect(route('admin.roles'))->withSuccess('Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {
        return view('admin.dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $role = Role::Where('id','=',$request->id)->get();
        return view('admin.role.edit',['role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
		$sValidationRules = [
			'name' => 'required',
		];
		$validator = Validator::make($request->all(), $sValidationRules);
		if ($validator->fails()) // on validator found any error 
		{
			return redirect(route('admin.role.edit',['id'=>$request->id]))->withErrors($validator)->withInput();
		}
		$admin = Role::find($request->id);
		$admin->name = $request->name;
        $admin->slug = $request->slug;
		$admin->status = $request->status;
		$admin->save();

		return redirect(route('admin.roles'))->withSuccess('Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Role::where('id', '=', $request->id)->delete();
        return redirect(route('admin.roles'))->withSuccess('Deleted successfully');
    }
    
    
    public function permissionlist(Request $request)
    {
        $roleid = $request->id;
        $mainpermission = Mainpermission::all();
        return view('admin.role.permissionlist',['mainpermission'=>$mainpermission,'roleid'=>$roleid]);
    }
    
    public function updatepermission(Request $request)
    {
        $roleid = $request->roleid;
        $permissionid = $request->permissionid;
        $status = $request->status;
        
        if($status == 'a'){
            $rolepermission = New Rolepermission();
            $rolepermission->role_id = $roleid;
            $rolepermission->permission_id = $permissionid;
            $rolepermission->created_at = DATE("Y-m-d H:i:s");
            $rolepermission->updated_at = DATE("Y-m-d H:i:s");
            $rolepermission->save();
        } else {
            Rolepermission::Where('role_id','=',$roleid)->Where('permission_id','=',$permissionid)->delete();
        }
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}
