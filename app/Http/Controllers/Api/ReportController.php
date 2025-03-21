<?php
namespace App\Http\Controllers\API;
 
use Illuminate\Http\Request;
use Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Laravel\Sanctum\HasApiTokens; 

use App\Models\User;
use App\Models\Payout;
use App\Models\Transaction; 
use App\Models\DailyCashback;
use App\Models\MonthlyCashback;
use App\Models\Fundrequest;
use App\Models\Recharge; 
use App\Models\PackageUpgrades;

use DB;
use Route;

class ReportController extends Controller
{
    public $token = true;
	public function __construct()
    {	
		if(Route::middleware('auth:sanctum')){
			return response()->json(['success' => false, 'message' => 'Unauthorized','data'=>array()], 401);
		}
    }
	
	public function transaction(Request $request)
	{
		DB::enableQueryLog();
		$customer = auth()->user()->id;
		$validator = Validator::make($request->all(), 
		[
			'walletType' => 'required',
			'fromDate' => 'required|date|before_or_equal:toDate',
			'toDate' => 'required|date',
		]);
		if ($validator->fails())			
			return response()->json(['success' => false,'errorcode'=>'04', 'message'=>$validator->errors()->first(), 'data'=>array()], 200);
		else
		{			
			$fromDate = $request->fromDate;
			$toDate = $request->toDate;
			if($request->walletType=='MAIN')
				$txn = Transaction::where('user_id', $customer)->whereDate('created_at', '>=', date('Y-m-d',strtotime($fromDate)))->whereDate('created_at', '<=', date('Y-m-d',strtotime($toDate)))->Orderby('id','DESC')->get(['id','opening', 'credit', 'debit', 'closing', 'message', 'created_at']);
			elseif($request->walletType=='CASHBACK')
				$txn = DailyCashback::where('user_id', $customer)->whereDate('created_at', '>=', date('Y-m-d',strtotime($fromDate)))->whereDate('created_at', '<=', date('Y-m-d',strtotime($toDate)))->Orderby('id','DESC')->get(['id','opening', 'credit', 'debit', 'closing', 'message', 'created_at']);
			elseif($request->walletType=='MONTHLY')
				$txn = MonthlyCashback::where('user_id', $customer)->whereDate('created_at', '>=', date('Y-m-d',strtotime($fromDate)))->whereDate('created_at', '<=', date('Y-m-d',strtotime($toDate)))->Orderby('id','DESC')->get(['id','opening', 'credit', 'debit', 'closing', 'message', 'created_at']);
			//$txn = MonthlyCashback::where('user_id', $customer)->whereBetween('created_at', [$fromDate, $toDate])->Orderby('id','DESC')->get(['id','opening', 'credit', 'debit', 'closing', 'message', 'created_at']);
			
			else
				$txn = [];
			$query = DB::getQueryLog();
			if($txn->isNotEmpty())
				return response()->json(['success' => true, 'message'=>'data found', 'data'=>$txn, 'qry'=>$query, 'date'=>date('Y-m-d H:i:s')], 200);
			else
				return response()->json(['success' => false, 'message'=>'data not found', 'data'=>$txn, 'qry'=>$query], 200);
		}
		
	}
	
	public function payouts(Request $request)
	{
		$validator = Validator::make($request->all(), 
		[
			'fromDate' => 'required|date|before_or_equal:toDate',
			'toDate' => 'required|date',
			'walletType' => 'required',
		]);
		if ($validator->fails())			
			return response()->json(['success' => false,'errorcode'=>'04', 'message'=>$validator->errors()->first(), 'data'=>array()], 200);
		else
		{
			$walletType = $request->walletType;
			if(in_array($walletType, ['MAIN', 'MONTHLY']))
			{
				$fromDate = $request->fromDate;
				$toDate = $request->toDate;
				$customer = auth()->user()->id;
				$txn = Payout::where('user_id', $customer)->where('wallet_type', $walletType)->whereDate('created_at', '>=', date('Y-m-d',strtotime($fromDate)))->whereDate('created_at', '<=', date('Y-m-d',strtotime($toDate)))->Orderby('id','DESC')->get();
				if($txn->isNotEmpty())
					return response()->json(['success' => true, 'message'=>'data found', 'data'=>$txn], 200);
				else
					return response()->json(['success' => false, 'message'=>'data not found', 'data'=>$txn], 200);
			}
			else
				return response()->json(['success' => false, 'message'=>'Invalid wallet type!', 'data'=>$txn], 200);				
		}
		
	}
	
	public function fundrequest(Request $request)
	{
		$validator = Validator::make($request->all(), 
		[
			'fromDate' => 'required|date|before_or_equal:toDate',
			'toDate' => 'required|date',
			'walletType' => 'required',
		]);
		if ($validator->fails())			
			return response()->json(['success' => false,'errorcode'=>'04', 'message'=>$validator->errors()->first(), 'data'=>array()], 200);
		else
		{
			$walletType = $request->walletType;
			if(in_array($walletType, ['MAIN', 'MONTHLY']))
			{
				$fromDate = $request->fromDate;
				$toDate = $request->toDate;
				$customer = auth()->user()->id;
				$txn = Fundrequest::where('user_id', $customer)->where('wallet_type', $walletType)->whereDate('created_at', '>=', date('Y-m-d',strtotime($fromDate)))->whereDate('created_at', '<=', date('Y-m-d',strtotime($toDate)))->Orderby('id','DESC')->get();
				if($txn->isNotEmpty())
					return response()->json(['success' => true, 'message'=>'data found', 'data'=>$txn], 200);
				else
					return response()->json(['success' => false, 'message'=>'data not found', 'data'=>$txn], 200);	
			}
			else
				return response()->json(['success' => false, 'message'=>'Invalid wallet type!', 'data'=>$txn], 200);		
		}					
	}
	
	public function recharge(Request $request)
	{
		$validator = Validator::make($request->all(), 
		[
			'fromDate' => 'required|date|before_or_equal:toDate',
			'toDate' => 'required|date',
		]);
		if ($validator->fails())			
			return response()->json(['success' => false,'errorcode'=>'04', 'message'=>$validator->errors()->first(), 'data'=>array()], 200);
		else
		{
			$fromDate = $request->fromDate;
			$toDate = $request->toDate;
			$customer = auth()->user()->id;			
			$txn = Recharge::where('user_id', $customer)->whereDate('created_at', '>=', date('Y-m-d',strtotime($fromDate)))->whereDate('created_at', '<=', date('Y-m-d',strtotime($toDate)))->orderby('id','DESC')->get(['id', 'mobileno', 'operator_name', 'amount', 'status', 'created_at']);			
			if($txn->isNotEmpty())
				return response()->json(['success' => true, 'message'=>'data found', 'data'=>$txn], 200);
			else
				return response()->json(['success' => false, 'message'=>'data not found', 'data'=>$txn], 200);	
		}				
	}
	
	public function packagePurchase(Request $request)
	{
		$validator = Validator::make($request->all(), 
		[
			'fromDate' => 'required|date|before_or_equal:toDate',
			'toDate' => 'required|date',
		]);
		if ($validator->fails())			
			return response()->json(['success' => false,'errorcode'=>'04', 'message'=>$validator->errors()->first(), 'data'=>array()], 200);
		else
		{
			$fromDate = $request->fromDate;
			$toDate = $request->toDate;
			$customer = auth()->user()->id;			
			$txn = PackageUpgrades::where('user_id', $customer)
				->whereDate('created_at', '>=', date('Y-m-d',strtotime($fromDate)))
				->whereDate('created_at', '<=', date('Y-m-d',strtotime($toDate)))
				->orderby('id','DESC')
				->get(['id', 'package_id', 'package_amount', 'txn_by', 'created_at']);
			if($txn->isNotEmpty())
				return response()->json(['success' => true, 'message'=>'data found', 'data'=>$txn], 200);
			else
				return response()->json(['success' => false, 'message'=>'data not found', 'data'=>$txn], 200);	
		}				
	}
	
}