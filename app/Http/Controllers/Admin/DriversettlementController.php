<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Adminsettlement;
use App\Models\Vendortransaction;
use File;
use Auth;
use DB;

class VendorsettlementController extends Controller
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
            return view('admin.adminsettlement.vendorheader',['title'=>'Admin settlement list']);
        else
        {
            $limit = 10;
            $serial[] = (request()->input('page')==0)?1:(($limit*(request()->input('page')-1))+1);
            $query = Adminsettlement::where('user_id','<','1')->where('vendor_id','>','0');
            
            if($request->input('skey')!=''){
                $query = $query->where('message','LIKE','%'.$request->input('skey').'%');
            }
            if($request->input('svendor')!='')
                $query = $query->where('vendor_id','=', $request->input('svendor'));

            if($request->input('sdate')!='')
                $query = $query->whereDate('created_at','=', $request->input('sdate'));

            $count = $query->count();
            $result = $query->orderBy('id','DESC')->paginate($limit);
            return view('admin.adminsettlement.vendortable',['serial'=>$serial,'count'=>$count,'result'=>$result]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.adminsettlement.vendorcreate');
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
            'id' => 'required',  
            'amount' => 'required',  
            'txn_type' => 'required',          
        ];
        $validator = Validator::make($request->all(), $sValidationRules);
        if ($validator->fails()) // on validator found any error 
        {
            return redirect(route('admin.vendorsettlement.create'))->withErrors($validator)->withInput();
        }        
        $admin = New Adminsettlement;
        $admin->vendor_id = $request->id;
        $admin->amount = $request->amount;
        $admin->txn_type = $request->txn_type;
        $admin->txn_date = $request->txn_date;
        $admin->payment_type = $request->paymenttype;
        $admin->message = $request->message;
        $admin->save();
		
		$balance = get_vendor_balance($request->id);
		$transaction = New Vendortransaction;
		$transaction->vendor_id = $request->id;
		$transaction->opening = $balance;
		if($request->txn_type=='Credit'){
			$transaction->credit = $request->amount;
			$transaction->closing = $balance+$request->amount;
		} else {
			$transaction->debit = $request->amount;
			$transaction->closing = $balance-$request->amount;
		}
		$transaction->message = $request->txn_type;
		$transaction->save();
		
        return redirect(route('admin.vendorsettlements'))->withSuccess('Updated successfully');
    }

}
