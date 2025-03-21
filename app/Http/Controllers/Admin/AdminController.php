<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Admin;
use App\Models\Role;
use App\Models\Adminrole;
use Auth;
use DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       /* $this->middleware('auth:admin');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->can(request()->segment(2))){
                return $next($request);
            }
            abort(403);
        });*/
    }

    /**
     * show dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->ajax())
            return view('admin.admin.header',['title'=>'Admin list']);
        else
        {
            $limit = 10;
            $serial[] = (request()->input('page')==0)?1:(($limit*(request()->input('page')-1))+1);
            $query = Admin::where('id','!=',Auth::user()->id);
            // Search Start
            if($request->input('skey')!=''){
                $query = $query->where('name','LIKE','%'.$request->input('skey').'%');
                $query = $query->OrWhere('mobile','LIKE','%'.$request->input('skey').'%');
                $query = $query->OrWhere('email','LIKE','%'.$request->input('skey').'%');
            }
            if($request->input('sstat')!='')
                $query = $query->where('row_status','=', $request->input('sstat'));

            if($request->input('sdate')!='')
                $query = $query->whereDate('created_at','=', $request->input('sdate'));
            // Search End
            $count = $query->count();
            $result = $query->orderBy('id','DESC')->paginate($limit);
            return view('admin.admin.table',['serial'=>$serial,'count'=>$count,'result'=>$result]);
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
        return view('admin.admin.create',['role'=>$role]);
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
            'email' => 'required|email|unique:admins',
            'mobile' => 'required|digits:10',
            'password' => 'required|required_with:password_again|same:password_again',
            'role' => 'required',
        ];
        $validator = Validator::make($request->all(), $sValidationRules);
        if ($validator->fails()) // on validator found any error 
        {
            return redirect(route('admin.admin.create'))->withErrors($validator)->withInput();
        }
        $admin = New Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;
        $admin->address = $request->address;
        $admin->password = bcrypt($request->password);
        $admin->save();
        
        for($i=0;$i<sizeof($request->role);$i++){
            $role = New Adminrole;
            $role->admin_id = $admin->id;
            $role->role_id = $request->role[$i];
            $role->save();
        }
        return redirect(route('admin.admins'))->withSuccess('Added successfully');
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
        $role = Role::Where('status','=','Active')->get();
        $adminrole = DB::SELECT("SELECT GROUP_CONCAT(role_id) as role_id FROM admins_role WHERE admin_id=$request->id");
        $admin = Admin::Where('id','=',$request->id)->get();
        return view('admin.admin.edit',['role'=>$role,'admin'=>$admin,'adminrole'=>$adminrole]);
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
            'email' => 'required|email|unique:admins,email,'.$request->id,
            'mobile' => 'required|digits:10',
            'role' => 'required',
        ];
        $validator = Validator::make($request->all(), $sValidationRules);
        if ($validator->fails()) // on validator found any error 
        {
            return redirect(route('admin.admin.create'))->withErrors($validator)->withInput();
        }
        $admin = Admin::find($request->id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;
        $admin->row_status = $request->status;
        $admin->address = $request->address;
        $admin->save();
        
        Adminrole::where('admin_id', '=', $admin->id)->delete();

        for($i=0;$i<sizeof($request->role);$i++){
            $role = New Adminrole;
            $role->admin_id = $admin->id;
            $role->role_id = $request->role[$i];
            $role->save();
        }
        return redirect(route('admin.admins'))->withSuccess('Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Admin::where('id', '=', $request->id)->delete();
        Adminrole::where('admin_id', '=', $request->id)->delete();
        return redirect(route('admin.admins'))->withSuccess('Deleted successfully');
    }
}
