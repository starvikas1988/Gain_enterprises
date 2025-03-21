<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Websiteconfig;
use Auth;
use App\User;
use DB;
use Session;

class WebsiteconfigController extends Controller
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
        $pages = Websiteconfig::Where('id',1)->get();
		return view('admin.websiteconfig.edit',['page'=>$pages]);
    }

	public function update(Request $request)
    {        
        $admin = Websiteconfig::find(1);
        $admin->app_version = $request->app_version;
        $admin->maintainance_mode = $request->maintainance_mode;
        $admin->save();
        return redirect(route('admin.websiteconfigs'))->withSuccess('Update successfully');
    }


}
