<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Vendortransaction;
use App\Models\Vendor;
use File;
use Auth;
use DB;

class VendortransactionController extends Controller
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
            return view('admin.vendortransaction.header',['title'=>'Transaction list']);
        else
        {
            $limit = 10;
            $serial[] = (request()->input('page')==0)?1:(($limit*(request()->input('page')-1))+1);
            $query = Vendortransaction::where('id','>','0');
            
            if($request->input('skey')!=''){
                $query = $query->where('message','LIKE','%'.$request->input('skey').'%');
            }
            if($request->input('svendor')!='')
                $query = $query->where('vendor_id','=', $request->input('svendor'));
            if($request->input('sdate')!='')
                $query = $query->whereDate('created_at','=', $request->input('sdate'));

            $count = $query->count();
            $result = $query->orderBy('id','DESC')->paginate($limit);
            return view('admin.vendortransaction.table',['serial'=>$serial,'count'=>$count,'result'=>$result]);
        }
    }
    
}
