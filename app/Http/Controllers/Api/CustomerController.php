<?php
namespace App\Http\Controllers\API;

use Validator;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Coupon;
use App\Models\UserAddress;


use App\Models\Notification;
use App\Models\Websiteconfig;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Laravel\Sanctum\HasApiTokens; 
use Route;
use Image;
use File;
use Hash;
use DB;

class CustomerController extends Controller
{
    public $token = true;
	public function __construct()
    {	
		if(Route::middleware('auth:sanctum')){
			return response()->json(['success' => false,'errorcode'=>'05','message' => 'Unauthorized','data'=>array()], 401);
		}		
    }
	
	public function profile()  
	{
		$customer = User::where('id', auth()->user()->id)->first(['id', 'name', 'mobile', 'gender', 'dob', 'email', 'balance', 'profileimg', 'created_at']);
		return response()->json(['success' => true,'errorcode'=>'00','message' => 'data found', 'data'=>$customer], 200);
	}
	
	public function changePassword(Request $request)
	{
		$input = $request->all();
		$userid = auth()->user()->id;		
		$validator = Validator::make($request->all(), 
		[
			'oldPassword' => 'required',
			'newPassword' => 'required',
		]);
		if ($validator->fails())			
			return response()->json(['success' => false,'errorcode'=>'04', 'message'=>$validator->errors()->first(), 'data'=>array()], 200);
		else 
		{
			$currentPassword = auth()->user()->password;
			if(Hash::check($request->oldPassword, $currentPassword))
			{
				$user = User::find($userid);
				$user->password = Hash::make($request->newPassword);
				$user->save();
				return response()->json(['success' => true,'errorcode'=>'00', 'message'=>'Password changed successfully.', 'data'=>array()], 200);
			}
			else
				return response()->json(['success' => false,'errorcode'=>'04', 'message'=>'Old password not matched!', 'data'=>array()], 200);
		}
	}
	
	public function getCartCount()
	{
	    $cartCount = Cart::where('user_id', auth::user()->id)
                    ->count();
        return response()->json(['success' => true,'errorcode'=>'00', 'message'=>'Success', 'data'=>['cartCount'=>$cartCount]], 200);
	}
	
	public function getorderValueByCart(Request $request)
	{
	    $userId = auth::user()->id;
	    $validator = Validator::make($request->all(), 
        [
            'cart' => 'required',
        ]);
    
        if ($validator->fails())
            return response()->json(['success' => false, 'errorcode' => '03', 'message' => $validator->errors()->first(), 'data' => []], 200);
        else
        {
            $cart = json_decode($request->input('cart'));
            $flag = 1;
            if($cart)
            {
                foreach($cart as $ct)
                {
                    $productData = Product::where('id', $ct->product_id)->where('status', 'A')->first();
                    if($productData)
                    {
                        $restaurantCategory = RestaurantCategory::where('restaurant_id', $ct->restaurant_id)
                            ->where('category_id', $productData->category_id)
                            ->where('status', 'A')
                            ->count();
                        if($restaurantCategory == 0)
                            $flag = 0;                      
                    }
                    else
                        $flag = 0; 
                }
                if($flag)
                {
                    $totalAmount = 0;
                    $totalGst = 0;
                    $totalDiscount = 0;
                    $subTotal = 0;
                    
                    foreach($cart as $ct)
                    {   
                        $restaurantData = Restaurant::where('id', $ct->restaurant_id)->first();
                       // dd($restaurantData);
                        $productData = Product::where('id', $ct->product_id)->where('status', 'A')->first();
                        
                        $amount = $productData->price*$ct->quantity;
                        $gstPercentage = $restaurantData->gst_percentage;
                        $gstType = $restaurantData->gst_type; //Including, Excluding 
                        
                        if ($gstType === 'Including')
                        {
                            $gstAmount = $amount - ($amount / (1 + ($gstPercentage / 100)));
                            
                        }
                        else
                        {
                            $gstAmount = $amount * ($gstPercentage / 100);
                        }
                        $totalAmount += $amount;
                        $totalGst += $gstAmount;
                        
                    }
                    
                    if ($gstType === 'Including')
                        $subTotal = $totalAmount - $totalGst;
                    else
                    {
                        $subTotal = $totalAmount;
                        $totalAmount = $totalAmount+$totalGst;
                    }
                    
                    $discountAmount = 0;
                    $couponCode = NULL;
                    if($request->couponCode)
                    {
                        $code = $request->couponCode;
                        $resp = $this->verifyCoupon($code, $totalAmount);
                        $couponData = $resp->getData();
                        if($couponData->success == true)
                        {
                            $couponCode = $code;
                            $discountAmount = $couponData->data[0]->discountAmount;
                        }
                    }
                    
                    $data = [
                        'subTotal' => round($subTotal, 2),
                        'taxType' => $gstType,
                        'cgst' => round($totalGst, 2)/2,
                        'sgst' => round($totalGst, 2)/2,
                        'totalGst' => round($totalGst, 2),
                        'totalDiscount' => $discountAmount,
                        'deliveyCharge' => 'Free',
                        'discountAmount' => $discountAmount,
                        'couponCode' => $couponCode,
                        'totalAmount' => round(round($totalAmount, 2) - $discountAmount, 2),
                    ];
                    return response()->json(['success' => true,'errorcode'=>'00','message' => 'SUCCESS', 'data'=>$data], 200);
                }
                else
                    return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Some product not available of this cart!', 'data'=>array()], 200);
            }
            else
    			return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Invalid cart format!', 'data'=>array()], 200);
        }
	}
	
	public function paymentAdd(Request $request)
    {
        $userId = auth()->user()->id;
        $validator = Validator::make($request->all(), 
        [
            'orderId' => 'required|numeric|exists:orders,id',
        ]);
    
        if ($validator->fails())
            return response()->json(['success' => false, 'errorcode' => '04', 'message' => $validator->errors()->first(), 'data' => []], 200);
        else
        {
            $orderId = $request->orderId;
            $orderData = Order::where('id', $orderId)
                            ->where('user_id', $userId)
                            ->count();
            if($orderData)
            {
                $amount = Order::where('id', $orderId)
                            ->where('user_id', $userId)
                            ->first()->total_amount;
                $payment = new Payment;
                $payment->user_id = $userId;
                $payment->amount = $amount;
                $payment->transaction_id = $orderId;
                $payment->created_at = date('Y-m-d H:i:s');
                $payment->updated_at = date('Y-m-d H:i:s');
                $payment->save();
                if($payment->id)
                {
                    $paymentData = [
                        'amount'   => $amount * 100, // 100 $amount * 100
                        'currency' => 'INR',
                        'receipt'  => 'GAINENTERPRISES PAYMENTS',
                        'notes'    => [
                            'notes_key_1' => $payment->id,
                            'notes_key_2' => ''
                        ]
                    ];
    
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://api.razorpay.com/v1/orders',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>json_encode($paymentData, true),
                      CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Basic cnpwX3Rlc3RfcThOTm9sY0NJNTNWZG86M1hYbm9Ta0ZqdTRiczRDc2pvMThNWnha'
                      ),
                    ));
                    
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $resp =  json_decode($response);
                    if(isset($resp->id))
                    {
                        $orderId = $resp->id;
                        $update = Payment::where('id', $payment->id)
                                    ->update(['order_id'=>$orderId]);
                        if($update)
                            return response()->json(['success' => true,'errorcode'=>'00','message' => 'SUCCESS', 'data'=>['paymentId'=>$orderId]], 200);
                        else
                            return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Payment failed! try again.', 'data'=>array()], 200);
                    }
                    else
                        return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Payment failed! try again.', 'data'=>array()], 200);
                }
                else
                    return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Payment insert failed! try again.', 'data'=>array()], 200); 
            }
            else
                return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Invalid order id!', 'data'=>array()], 200);
        }
    }
    
    public function getCartProductQuantityByRestaurantId(Request $request)
	{
	    $userid = auth()->user()->id;
	    $validator = Validator::make($request->all(), 
        [
            'restaurantId' => 'required|numeric',
            'productId' => 'required|numeric',
        ]);
    
        if ($validator->fails())
            return response()->json(['success' => false, 'errorcode' => '03', 'message' => $validator->errors()->first(), 'data' => []], 200);
        else
        {
            $cartData = Cart::where('user_id', $userid)
                        ->where('product_id', $request->productId)
                        ->where('restaurant_id', $request->restaurantId)
                        ->first();
            if($cartData)
                $qty = $cartData->qty;
            else
                $qty = 0;
            return response()->json(['success' => true, 'errorcode' => '00', 'message' => 'data found', 'data' => ['qty' => $qty]], 200);
        }
	}
    
    // public function getAllProductByRestaurantIdWithFilter(Request $request)
	// {
	//     $userid = auth()->user()->id;
	//     $validator = Validator::make($request->all(), 
    //     [
    //         'restaurantId' => 'required',
    //     ]);
    
    //     if ($validator->fails())
    //         return response()->json(['success' => false, 'errorcode' => '03', 'message' => $validator->errors()->first(), 'data' => []], 200);
    //     else
    //     {
    //         $query = Restaurant::with('categories.category.products')->where('status', 'A');
            
    //         $restaurant = $query->where('id', $request->restaurantId)->first();
        
    //         if (!$restaurant) {
    //             return response()->json(['success' => false, 'errorcode' => '03', 'message' => 'No data found!', 'data' => []], 200);
    //         }
        
    //         $categories = $restaurant->categories->sortByDesc('category_id');
        
    //         $staticCategory = [
    //             'category_id' => 0,
    //             'category_name' => 'All',
    //             'icon' => NULL,
    //         ];
            
    //         $restaurantId = $request->restaurantId;
    //         $formattedRestaurant = [
    //             'id' => $restaurant->id,
    //             'name' => $restaurant->name,
    //             'image' => $restaurant->image,
    //             'rating' => $restaurant->rating,
    //             'availability' => $restaurant->availability,
    //             'categories' => collect([$staticCategory])
    //                 ->merge($categories->map(function ($restaurantCategory) {
    //                     return [
    //                         'category_id' => $restaurantCategory->category->id,
    //                         'category_name' => $restaurantCategory->category->name,
    //                         'icon' => $restaurantCategory->category->icon,
    //                     ];
    //                 }))
    //                 ->values(),
    //             'products' => $categories->flatMap(function ($restaurantCategory) use ($request, $userid, $restaurantId) {
    //                 if ($request->categoryId && $restaurantCategory->category_id == $request->categoryId) {
    //                     return $restaurantCategory->category->products->map(function ($product) use ($userid, $restaurantId) {
    //                         $cart = Cart::where('user_id', $userid)->where('product_id', $product->id)->where('restaurant_id', $restaurantId)->first();
    //                         return [
    //                             'product_id' => $product->id,
    //                             'product_name' => $product->name,
    //                             'product_image' => $product->image,
    //                             'price' => $product->price,
    //                             'description' => $product->description,
    //                             'cart_quantity'=>  ($cart) ? $cart->qty : '0',
    //                         ];
    //                     });
    //                 } elseif (!$request->categoryId) {
    //                     return $restaurantCategory->category->products->map(function ($product) use ($userid, $restaurantId) {
    //                         $cart = Cart::where('user_id', $userid)->where('product_id', $product->id)->where('restaurant_id', $restaurantId)->first();
    //                         return [
    //                             'product_id' => $product->id,
    //                             'product_name' => $product->name,
    //                             'product_image' => $product->image,
    //                             'price' => $product->price,
    //                             'description' => $product->description,
    //                             'cart_quantity'=>  ($cart) ? $cart->qty : '0',
    //                         ];
    //                     });
    //                 }
    //                 return [];
    //             }),

    //         ];
    //         return response()->json(['success' => true, 'errorcode' => '00', 'message' => 'data found', 'data' => $formattedRestaurant], 200);
    //     }
	// }
    public function getAllProductByRestaurantIdWithFilter(Request $request)
    {
        $userid = auth()->user()->id;
      
       
      
        $validator = Validator::make($request->query(),  
        [
            'restaurantId' => 'required',
            // 'table_id' => 'required', 
            // 'user_id' => 'required', 
        ]);
      
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errorcode' => '03', 'message' => $validator->errors()->first(), 'data' => []], 200);
        }
    
        // Store or update the user-restaurant-table relationship in pivot table
        DB::table('user_restaurant_tables')
        ->updateOrInsert(
            ['user_id' => $request->user_id, 'restaurant_id' => $request->restaurantId], // Search condition
            ['table_id' => $request->table_id, 'updated_at' => now()] // Values to update or insert
        );
    
        $query = Restaurant::with('categories.category.products')->where('status', 'A');
        $restaurant = $query->where('id', $request->restaurantId)->first();
       
    
        if (!$restaurant) {
            return response()->json(['success' => false, 'errorcode' => '03', 'message' => 'No data found!', 'data' => []], 200);
        }
    
        $categories = $restaurant->categories->sortByDesc('category_id');
    
        $staticCategory = [
            'category_id' => 0,
            'category_name' => 'All',
            'icon' => NULL,
        ];
    
        $restaurantId = $request->restaurantId;
        $formattedRestaurant = [
            'id' => $restaurant->id,
            'name' => $restaurant->name,
            'image' => $restaurant->image,
            'rating' => $restaurant->rating,
            'availability' => $restaurant->availability,
            'table_id' => $request->table_id, // Return the stored table_id
            'categories' => collect([$staticCategory])
                ->merge($categories->map(function ($restaurantCategory) {
                    return [
                        'category_id' => $restaurantCategory->category->id,
                        'category_name' => $restaurantCategory->category->name,
                        'icon' => $restaurantCategory->category->icon,
                    ];
                }))
                ->values(),
            'products' => $categories->flatMap(function ($restaurantCategory) use ($request, $userid, $restaurantId) {
                return $restaurantCategory->category->products->map(function ($product) use ($userid, $restaurantId) {
                    $cart = Cart::where('user_id', $userid)->where('product_id', $product->id)->where('restaurant_id', $restaurantId)->first();
                    return [
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'product_image' => $product->image,
                        'price' => $product->price,
                        'description' => $product->description,
                        'cart_quantity' => ($cart) ? $cart->qty : '0',
                    ];
                });
            }),
        ];
    
        return response()->json(['success' => true, 'errorcode' => '00', 'message' => 'Data found', 'data' => $formattedRestaurant], 200);
    }
    

    public function verifyPayments(Request $request)
    {
        
        $userId = auth()->user()->id;
        $validator = Validator::make($request->all(), 
        [
            'orderId' => 'required|numeric|exists:orders,id',
            'paymentId' => 'required'
        ]);
    
        if ($validator->fails())
            return response()->json(['success' => false, 'errorcode' => '04', 'message' => $validator->errors()->first(), 'data' => []], 200);
        else
        {
            $orderId = $request->orderId;
            $paymentId = $request->paymentId;
            $orderData = Order::where('id', $orderId)
                            ->where('user_id', $userId)
                            ->count();
            if($orderData)
            {
                
                $paymentData = Payment::where('user_id', $userId)
                                ->where('status', 'FAILED')
                                ->where('transaction_id', $orderId)
                                ->first();
                
                if($paymentData)
                {
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://api.razorpay.com/v1/payments/'.$paymentId,
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'GET',
                      CURLOPT_HTTPHEADER => array(
                        'Authorization: Basic cnpwX3Rlc3RfcThOTm9sY0NJNTNWZG86M1hYbm9Ta0ZqdTRiczRDc2pvMThNWnha'
                      ),
                    ));
                    
                    $resp = curl_exec($curl);
                    curl_close($curl);
                    $response = json_decode($resp);
                    if($response)
					{
						Payment::where('id', $paymentData->id)
							->update(['response'=>json_encode($response, true), 'payment_id'=>$request->paymentId, 'updated_at'=>date('Y-m-d H:i:s')]);
						Order::where('id', $orderId)
							->update(['payment_status'=>'FAILED', 'updated_at'=>date('Y-m-d H:i:s')]);
						if(isset($response->status))
						{
							if($response->status == 'authorized' || $response->status == 'captured')
							{
								Payment::where('id', $paymentData->id)
									->update(['status'=>'SUCCESS']);
								$amount = ($response->amount/100);
								if($amount == $paymentData->amount)
								{
									Order::where('id', $orderId)
									    ->update(['order_status'=>'Processing', 'payment_status'=>'SUCCESS', 'updated_at'=>date('Y-m-d H:i:s')]);
									return response()->json(['success' => true,'errorcode'=>'00','message' => 'Your payment was successful.', 'data'=>[]], 200);
								}
								else
								    return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Amount mismatch! payment failed!', 'data'=>array()], 200);
							}
							else
							    return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Your last payment was failed!', 'data'=>array()], 200);
						}
						else
						    return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Invalid Payment!', 'data'=>array()], 200);
					}
					else
					    return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Invalid Payment!', 'data'=>array()], 200);
                }
                else
                    return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Invalid payment request!', 'data'=>array()], 200);
            }
            else
                return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Invalid payment request!', 'data'=>array()], 200);
        }
    }

    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'restaurantId' => 'required|numeric|exists:restaurants,id',
            'productId' => 'required|numeric|exists:products,id',
            'qty' => 'required|numeric',
            'table_id' => 'nullable|numeric|exists:restaurant_tablenumbers,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errorcode' => '04',
                'message' => $validator->errors()->first(),
                'data' => []
            ], 200);
        }

        $userId = auth()->user()->id;
        $restaurantId = $request->input('restaurantId');
        $productId = $request->input('productId');
        $tableId = $request->input('tableId'); // optional

        $restaurant = Restaurant::where('id', $restaurantId)
            ->where('status', 'A')
            ->where('availability', 'OPEN')
            ->first();

        $product = Product::where('id', $productId)
            ->where('status', 'A')
            ->first();

        if ($restaurant && $product) {
            $exist = RestaurantCategory::where('restaurant_id', $restaurantId)
                ->where('category_id', $product->category_id)
                ->count();

            if ($exist) {
                $cartQuery = Cart::where('user_id', $userId)
                    ->where('restaurant_id', $restaurantId)
                    ->where('product_id', $productId);

                if ($tableId) {
                    $cartQuery->where('table_id', $tableId);
                } else {
                    $cartQuery->whereNull('table_id');
                }

                $cartData = $cartQuery->first();

                if ($cartData) {
                    $qty = $request->qty;
                    if ($qty > 0) {
                        $cartData->product_price = $product->price;
                        $cartData->qty = $qty;
                        $cartData->total_amount = $product->price * $qty;
                        $cartData->updated_at = now();
                        $cartData->save();
                        $message = 'Cart updated successfully.';
                    } else {
                        return response()->json([
                            'success' => false,
                            'errorcode' => '03',
                            'message' => 'Invalid request!',
                            'data' => []
                        ], 200);
                    }
                } else {
                    $cartData = new Cart;
                    $cartData->user_id = $userId;
                    $cartData->restaurant_id = $restaurantId;
                    $cartData->product_id = $productId;
                    $cartData->product_price = $product->price;
                    $cartData->qty = $request->qty;
                    $cartData->total_amount = $product->price * $request->qty;
                    $cartData->created_at = now();
                    $cartData->updated_at = now();
                    if ($tableId) {
                        $cartData->table_id = $tableId;
                    }
                    $cartData->save();
                    $message = 'Cart added successfully.';
                }

                $userCart = Cart::with('product:id,name,price,image')
                    ->select('id', 'restaurant_id', 'product_id', 'product_price', 'qty', 'total_amount', 'table_id')
                    ->where('user_id', $userId)
                    ->orderBy('id', 'DESC')
                    ->get();

                return response()->json([
                    'success' => true,
                    'errorcode' => '00',
                    'message' => $message,
                    'data' => $userCart
                ], 200);

            } else {
                return response()->json([
                    'success' => false,
                    'errorcode' => '03',
                    'message' => 'Product not available to this restaurant!',
                    'data' => []
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
                'errorcode' => '03',
                'message' => 'Product or Restaurant not active!',
                'data' => []
            ], 200);
        }
    }

	
	// public function addToCart(Request $request)
	// {
	//     $validator = Validator::make($request->all(), 
    //     [
    //         'restaurantId' => 'required|numeric|exists:restaurants,id',
    //         'productId' => 'required|numeric|exists:products,id',
    //         'qty' => 'required|numeric',
    //         //'type' => 'required|in:PLUS,MINUS',
    //     ]);
    
    //     if ($validator->fails())
    //         return response()->json(['success' => false, 'errorcode' => '04', 'message' => $validator->errors()->first(), 'data' => []], 200);
    //     else
    //     {
    //         $userId = auth()->user()->id;
    //         $restaurantId = $request->input('restaurantId');
    //         $productId = $request->input('productId');
            
    //         $restaurant = Restaurant::where('id', $restaurantId)->where('status','A')->where('availability', 'OPEN')->first();
    //         $product = Product::where('id', $productId)->where('status', 'A')->first();
    //         if($restaurant && $product)
    //         {
    //             $exist = RestaurantCategory::where('restaurant_id', $restaurantId)->where('category_id', $product->category_id)->count();
    //             if($exist)
    //             {
    //                 $cartData = Cart::where('user_id', $userId)
    //                                 ->where('restaurant_id', $restaurantId)
    //                                 ->where('product_id', $productId)
    //                                 ->first();
    //                 if($cartData)
    //                 {
    //                     $qty = $request->qty;
    //                     if($qty > 0)
    //                     {
    //                         $cartData->product_price = $product->price;
    //                         $cartData->qty = $qty;
    //                         $cartData->total_amount = ($product->price*$qty);
    //                         $cartData->updated_at = date('Y-m-d H:i:s');
    //                         $cartData->save();
    //                         $message = 'Cart updated successfully.';
    //                     }
    //                     else
    //                         return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Invalid request!', 'data'=>array()], 200);
    //                 }
    //                 else
    //                 {
    //                     $cartData = new Cart;
    //                     $cartData->user_id = $userId;
    //                     $cartData->restaurant_id = $restaurantId;
    //                     $cartData->product_id = $productId;
    //                     $cartData->product_price = $product->price;
    //                     $cartData->qty = $request->qty;
    //                     $cartData->total_amount = ($product->price*$request->qty);
    //                     $cartData->created_at = date('Y-m-d H:i:s');
    //                     $cartData->updated_at = date('Y-m-d H:i:s');
    //                     $cartData->save();
    //                     $message = 'Cart added successfully.';
    //                 }
    //                 $userCart = Cart::with('product:id,name,price,image')
    //                             ->select('id', 'restaurant_id', 'product_id', 'product_price', 'qty', 'total_amount')
    //                             ->where('user_id', $userId)
    //                             ->orderBy('id', 'DESC')
    //                             ->get();
    //                 return response()->json(['success' => true,'errorcode'=>'00','message' => $message, 'data'=>$userCart], 200);
    //             }
    //             else
    //                 return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Product not available to this restaurant!', 'data'=>array()], 200);
    //         }
    //         else
    //             return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Product or Restaurant not active!', 'data'=>array()], 200);
    //     }
	// }
	
	public function getCartList(Request $request)
	{
	    $userId = auth()->user()->id;
	    $userCart = Cart::with('product:id,name,image')
                    ->select('id', 'restaurant_id', 'product_id', 'product_price', 'qty as quantity', 'total_amount')
                    ->where('user_id', $userId)
                    ->orderBy('id', 'DESC')
                    ->get();
        if($userCart->isNotEmpty())
        {
            return response()->json(['success' => true,'errorcode'=>'00','message' => 'SUCCESS', 'data'=>$userCart], 200);
        }
        else
            return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'No cart item found!', 'data'=>array()], 200);
	}
	
	public function deleteCartByProductId(Request $request)
	{
	    $validator = Validator::make($request->all(), 
        [
            'productId' => 'required|numeric',
            'restaurantId' => 'required|numeric',
        ]);
    
        if ($validator->fails())
            return response()->json(['success' => false, 'errorcode' => '03', 'message' => $validator->errors()->first(), 'data' => []], 200);
        else
        {
            $userId = auth()->user()->id;
            $cartData = Cart::where('user_id', $userId)
                        ->where('product_id', $request->productId)
                        ->where('restaurant_id', $request->restaurantId)
                        ->count();
            if($cartData)
            {
                Cart::where('user_id', $userId)->where('product_id', $request->productId)->where('restaurant_id', $request->restaurantId)->forceDelete();
                $userCart = Cart::with('product:id,name,price,image')
                            ->select('id', 'restaurant_id', 'product_id', 'product_price', 'qty', 'total_amount')
                            ->where('user_id', $userId)
                            ->orderBy('id', 'DESC')
                            ->get();
                return response()->json(['success' => true,'errorcode'=>'00','message' => 'Cart deleted successfully.', 'data'=>$userCart], 200);
            }
            else
                return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Invalid request!', 'data'=>array()], 200);
        }
	}
	
	
	public function deleteCartById(Request $request)
	{
	    $validator = Validator::make($request->all(), 
        [
            'cartId' => 'required|numeric|exists:carts,id',
        ]);
    
        if ($validator->fails())
            return response()->json(['success' => false, 'errorcode' => '03', 'message' => $validator->errors()->first(), 'data' => []], 200);
        else
        {
            $userId = auth()->user()->id;
            $cartData = Cart::where('user_id', $userId)
                        ->where('id', $request->cartId)
                        ->count();
            if($cartData)
            {
                Cart::where('id', $request->cartId)->forceDelete();
                $userCart = Cart::with('product:id,name,price,image')
                            ->select('id', 'restaurant_id', 'product_id', 'product_price', 'qty', 'total_amount')
                            ->where('user_id', $userId)
                            ->orderBy('id', 'DESC')
                            ->get();
                return response()->json(['success' => true,'errorcode'=>'00','message' => 'Cart deleted successfully.', 'data'=>$userCart], 200);
            }
            else
                return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Invalid request!', 'data'=>array()], 200);
        }
	}
	
	
	
	public function placeOrder(Request $request)
	{
	    $userId = auth::user()->id;
	    $validator = Validator::make($request->all(), 
        [
            'cart' => 'required',
            'orderType' => 'required',
            'addressId' => 'required_if:orderType,Delivery',
        ]);
    
        if ($validator->fails())
            return response()->json(['success' => false, 'errorcode' => '03', 'message' => $validator->errors()->first(), 'data' => []], 200);
        else
        {
            $cart = json_decode($request->input('cart'));
            $flag = 1;
            if($cart)
            {
                foreach($cart as $ct)
                {
                    $productData = Product::where('id', $ct->product_id)->where('status', 'A')->first();
                    if($productData)
                    {
                        $restaurantCategory = RestaurantCategory::where('restaurant_id', $ct->restaurant_id)
                            ->where('category_id', $productData->category_id)
                            ->where('status', 'A')
                            ->count();
                        if($restaurantCategory == 0)
                            $flag = 0;                      
                    }
                    else
                        $flag = 0; 
                }
                if($flag)
                {
                    $totalAmount = 0;
                    $totalGst = 0;
                    foreach($cart as $ct)
                    {   
                        $restaurantData = Restaurant::where('id', $ct->restaurant_id)->first();
                        $productData = Product::where('id', $ct->product_id)->where('status', 'A')->first();
                        
                        $amount = $productData->price*$ct->quantity;
                        $gstPercentage = $restaurantData->gst_percentage;
                        $gstType = $restaurantData->gst_type; //Including, Excluding 
                        
                        if ($gstType === 'Including')
                            $gstAmount = $amount - ($amount / (1 + ($gstPercentage / 100)));
                        else
                            $gstAmount = $amount * ($gstPercentage / 100);
                        
                        $totalAmount += $amount;
                        $totalGst += $gstAmount;
                    }
                    $discountAmount = 0;
                    $couponCode = NULL;
                    if($request->couponCode)
                    {
                        $code = $request->couponCode;
                        $resp = $this->verifyCoupon($code, $totalAmount);
                        $couponData = $resp->getData();
                        if($couponData->success == true)
                        {
                            $couponCode = $code;
                            $discountAmount = $couponData->data[0]->discountAmount;
                        }
                    }
                    
                    if($request->orderType == 'Delivery')
                    {
                        $addressData = UserAddress::where('user_id', $userId)
		                    ->where('id', $request->addressId)
		                    ->count();
		                if($addressData == 0)
		                    return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Invalid address id!', 'data'=>array()], 200); 
                    }

                    if($request->orderType == 'Dine In'){
                        
                        $defaultTableId = now()->timestamp;
                    }else{
                        $defaultTableId = NULL;
                    }   
                   

                    
                    // if($request->addressId == 'null')
                    //     $request->addressId = 
                    
                    $order = new Order;
                    $order->user_id = $userId;
                    $order->address_id = ($request->addressId ? $request->addressId :NULL);
                    $order->order_type = $request->orderType;
                    $order->restaurant_id = $request->restaurant_id;
                    $order->table_id = $defaultTableId;
                    $order->created_by = $request->created_by;
                    $order->total_amount = $totalAmount - $discountAmount;
                    $order->total_discount = $discountAmount;
                    $order->coupon_code = $couponCode;
                    $order->coupon_amount = $discountAmount;
                    $order->total_tax = $totalGst;
                    $order->gst_type = $restaurantData->gst_type;
                    $order->gst_percentage = $gstPercentage;
                    $order->cgst = $totalGst/2;
                    $order->sgst = $totalGst/2;
                    $order->order_status = 'Pending';
                    $order->payment_status = 'Pending';
                    $order->created_at = date('Y-m-d H:i:s');
                    $order->updated_at = date('Y-m-d H:i:s');
                    $order->save();
                    
                    if($order->id)
                    {
                        foreach($cart as $ct)
                        {   
                            $restaurantData = Restaurant::where('id', $ct->restaurant_id)->first();
                            $productData = Product::where('id', $ct->product_id)->where('status', 'A')->first();
                            $amount = $productData->price;
                            
                            $orderItem = new OrderItem;   
                            $orderItem->order_id = $order->id;
                            $orderItem->user_id	 = $userId;
                            $orderItem->restaurant_id = $ct->restaurant_id;
                            $orderItem->product_id = $ct->product_id;
                            $orderItem->quantity = $ct->quantity;
                            $orderItem->amount = $amount;
                            $orderItem->total_amount = $amount*$ct->quantity;
                            $orderItem->created_at = date('Y-m-d H:i:s');
                            $orderItem->updated_at = date('Y-m-d H:i:s');
                            $orderItem->save();
                        }
                        return response()->json(['success' => true,'errorcode'=>'00','message' => 'Order placed successfully.', 'data'=>['orderId'=>$order->id]], 200);
                    }
                    else
                        return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Failed! try after some time.', 'data'=>array()], 200);
                }
                else
                    return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Some product not available of this cart!', 'data'=>array()], 200);
            }
            else
    			return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Invalid cart format!', 'data'=>array()], 200);
        }
	}
	
	public function getOrderList(Request $request)
	{
	    $userId = auth()->user()->id;
	    $orderData = Order::where('user_id', $userId)
	               ->orderBy('id', 'DESC')
	               ->get(['id', 'order_type', 'total_amount', 'order_status', 'payment_status', 'created_at']);
	   if($orderData->isNotEmpty())
            return response()->json(['success' => true,'errorcode'=>'00','message' => 'data found', 'data'=>$orderData], 200);
		else
			return response()->json(['success' => false,'errorcode'=>'04', 'message'=>'No order found!', 'data'=>array()], 200);
	    
	}
	
	public function getOrderDetailById(Request $request)
	{
	    $userId = auth()->user()->id;
	    $validator = Validator::make($request->all(), 
        [
            'orderId' => 'required',
        ]);
        if ($validator->fails())
            return response()->json(['success' => false, 'errorcode' => '03', 'message' => $validator->errors()->first(), 'data' => []], 200);
        else
        {
            $orderData = Order::where('user_id', $userId)
                        ->with(['address:id,name,mobile_no,address,city,state,country,pincode'])
                        ->where('id', $request->orderId)
                        ->get(['id', 'address_id', 'order_type', 'total_amount', 'total_tax', 'gst_percentage', 'gst_type', 'cgst', 'sgst', 'total_discount', 'coupon_amount', 'coupon_code', 'order_status', 'payment_status', 'created_at']);
    	   if($orderData->isNotEmpty())
    	   {
    	       foreach($orderData as $od)
    	       {
    	           $od->items = OrderItem::where('order_id', $od->id)
    	                        ->select('quantity', 'amount', 'total_amount', 'restaurant_id', 'product_id')
    	                        ->with(['product:id,name,image', 'restaurant:id,name,image,rating'])
    	                        ->get();
    	       }
    	       return response()->json(['success' => true,'errorcode'=>'00','message' => 'data found', 'data'=>$orderData], 200);
    	   }
    		else
    			return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'No order found!', 'data'=>array()], 200);
        }
	}
	
	public function applyCoupon(request $request)
	{
	    $validator = Validator::make($request->all(), 
        [
            'couponCode' => 'required',
            'totalAmount' => 'required',
        ]);
    
        if ($validator->fails())
            return response()->json(['success' => false, 'errorcode' => '03', 'message' => $validator->errors()->first(), 'data' => []], 200);
        else
            return $this->verifyCoupon($request->couponCode, $request->totalAmount);
	}
	
	private function verifyCoupon($code, $totalAmount)
	{
	    $couponData = Coupon::where('code', $code)
                            ->where('status', 'A')
                            ->first();
        if($couponData)
        {
            $today = date('Y-m-d');
            if($couponData->start_date <= $today)
            {
                if($couponData->end_date >= $today)
                {
                    if($totalAmount >= $couponData->required_amount)
                    {
                        $data = [
                            'discountAmount' => round(($totalAmount*$couponData->discount_percentage/100),2),
                            'description' => $couponData->description,
                        ];
                        return response()->json(['success' => true,'errorcode'=>'00','message' => 'Coupon applied successfully.', 'data'=>[$data]], 200);
                    }
                    else
                        return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Required amount ₹'.($couponData->required_amount-$totalAmount).' more to cart for apply this coupon!', 'data'=>array()], 200);
                }
                else
                    return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Coupon code expired!', 'data'=>array()], 200);
            }
            else
                return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Coupon code not valid for today!', 'data'=>array()], 200);
        }
        else
            return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Invalid coupon code!', 'data'=>array()], 200);
	}
	
	public function notificationlist()
	{
		$notification = Notification::Where('notification_type','Customer')->OrWhereIn('user_id', [auth()->user()->id])->get(); 
		if($notification->isNotEmpty())
			return response()->json(['success' => true,'errorcode'=>'00','message' => 'data found', 'data'=>$notification], 200);
		else
			return response()->json(['success' => false,'errorcode'=>'04', 'message'=>'No data found!', 'data'=>array()], 200);	
	}
	
	public function updateprofileimg(Request $request)
	{
		$input = $request->all();
		$userid = auth()->user()->id;
		$validator = Validator::make($request->all(), 
		[
			'images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
		]);
		if ($validator->fails()) {
			return response()->json(['success' => false,'errorcode'=>'04', 'message'=>$validator->errors()->first(), 'data'=>array()], 200);			
		} else {			
			if ($request->hasFile('image')) 
			{
				$imageName = time().'.'.$request->image->extension();      
				$path = 'public/profileimg/'.$imageName;
				$request->image->move(public_path('profileimg'), $imageName);

				$address = User::find($userid);
				$address->profileimg = $path;
				$address->save();
				return response()->json(['success' => true,'errorcode'=>'00', 'message'=>"Updated successfully.", 'data'=>array()], 200);	
			}
			else {
				return response()->json(['success' => false,'errorcode'=>'02', 'message'=>"Invalid image file", 'data'=>array()], 200);	
			}
		}
	}
	
	public function addUserAddress(Request $request)
	{
	    $input = $request->all();
		$userid = auth()->user()->id;
		$validator = Validator::make($request->all(), 
		[
            'name' => 'required',
            'mobile_no' => 'required|numeric',
			'address' => 'required',
			'city' => 'required',
			'state' => 'required',
			'country' => 'required',
			'pincode' => 'required|numeric|digits:6',
		]);
		if ($validator->fails()) {
			return response()->json(['success' => false,'errorcode'=>'03', 'message'=>$validator->errors()->first(), 'data'=>array()], 200);			
		} 
		else 
		{
			$address = new UserAddress;
			$address->user_id = $userid;
			$address->name = $request->name;
			$address->mobile_no = $request->mobile_no;
			$address->address = $request->address;
			$address->city = $request->city;
			$address->state = $request->state;
			$address->country = $request->country;
			$address->pincode = $request->pincode;
			$address->save();
			return response()->json(['success' => true,'errorcode'=>'00', 'message'=>"Address added successfully.", 'data'=>array()], 200);
		}
	}
	
	public function getUserAddressList()
	{
		$userid = auth()->user()->id;
		$address = UserAddress::where('user_id', $userid)->get(['id', 'name', 'mobile_no', 'address', 'pincode', 'city', 'state', 'country']);
	    if($address->isNotEmpty())
		    return response()->json(['success' => true,'errorcode'=>'00', 'message'=>"SUCCESS", 'data'=>$address], 200);
		else 
			return response()->json(['success' => false,'errorcode'=>'03', 'message'=>"No data found!", 'data'=>array()], 200);	
	}
	
	public function updateUserAddress(Request $request)
	{
	    $input = $request->all();
		$userid = auth()->user()->id;
		$validator = Validator::make($request->all(), 
		[
		    'addressId' => 'required',
            'name' => 'required',
            'mobile_no' => 'required|numeric',
			'address' => 'required',
			'city' => 'required',
			'state' => 'required',
			'country' => 'required',
			'pincode' => 'required|numeric|digits:6',
		]);
		if ($validator->fails()) {
			return response()->json(['success' => false,'errorcode'=>'03', 'message'=>$validator->errors()->first(), 'data'=>array()], 200);			
		} 
		else 
		{
		    $addressData = UserAddress::where('user_id', $userid)
		                    ->where('id', $request->addressId)
		                    ->first();
		    if($addressData)
		    {
		        $address = UserAddress::find($request->addressId);
    			$address->name = $request->name;
    			$address->mobile_no = $request->mobile_no;
    			$address->address = $request->address;
    			$address->city = $request->city;
    			$address->state = $request->state;
    			$address->country = $request->country;
    			$address->pincode = $request->pincode;
    			$address->save();
    			return response()->json(['success' => true,'errorcode'=>'00', 'message'=>"Address updated successfully.", 'data'=>array()], 200);
		    }
		    else
		        return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Invalid address id!', 'data'=>array()], 200);	
		}
	}
	
	public function deleteUserAddress(Request $request)
	{
	    $input = $request->all();
		$userid = auth()->user()->id;
		$validator = Validator::make($request->all(), 
		[
		    'addressId' => 'required',
		]);
		if ($validator->fails()) {
			return response()->json(['success' => false,'errorcode'=>'03', 'message'=>$validator->errors()->first(), 'data'=>array()], 200);			
		} 
		else 
		{
		    $addressData = UserAddress::where('user_id', $userid)
		                    ->where('id', $request->addressId)
		                    ->first();
		    if($addressData)
		    {
		       UserAddress::where('user_id', $userid)
                    ->where('id', $request->addressId)
                    ->delete();
    			return response()->json(['success' => true,'errorcode'=>'00', 'message'=>"Address deleted successfully.", 'data'=>array()], 200);
		    }
		    else
		        return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Invalid address id!', 'data'=>array()], 200);	
		}
	}
	
	public function updateprofile(Request $request)
	{
		$input = $request->all();
		$userid = auth()->user()->id;
		$validator = Validator::make($request->all(), 
		[
            'gender' => 'required',
			'name' => 'required',
			'dob' => 'required',
			'email' => 'required',
		]);
		if ($validator->fails()) {
			return response()->json(['success' => false,'errorcode'=>'04', 'message'=>$validator->errors()->first(), 'data'=>array()], 200);			
		} else {
			$address = User::find($userid);
			$address->name = $request->name;
			$address->gender = $request->gender;
			$address->email = strtolower($request->email);
			$address->dob = date('Y-m-d', strtotime($request->dob));
			$address->save();
			return response()->json(['success' => true,'errorcode'=>'00', 'message'=>"Updated successfully.", 'data'=>array()], 200);
		}
	}	
	
	public function mainwallet()
	{
		$transaction = Transaction::Where('user_id',auth()->user()->id)->OrderBy('id','DESC')->get(); 
		if($transaction->isNotEmpty())
			return response()->json(['success' => true,'errorcode'=>'00','message' => 'data found', 'data'=>$transaction], 200);
		else
			return response()->json(['success' => false,'errorcode'=>'04', 'message'=>'No data found!', 'data'=>array()], 200);	
	}
	
	public function logout()
	{
        auth()->user()->currentAccessToken()->delete();
        return response()->json(['success' => true,'errorcode'=>'00', 'message'=>'Logout successfully.', 'data'=>array()], 200);
    }
	
	public function updatedevicetoken(Request $request)
	{
		User::Where('id',auth()->user()->id)->update(['device_id'=>$request->deviceid]); 
		return response()->json(['success' => true,'message' => 'updated successfully', 'data'=>array()], 200);
	}
	
	public static function slugify($text, string $divider = '-')
	{
	  	$text = preg_replace('~[^\pL\d]+~u', $divider, $text);
	  	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	  	$text = preg_replace('~[^-\w]+~', '', $text);
	  	$text = trim($text, $divider);
	  	$text = preg_replace('~-+~', $divider, $text);
	  	$text = strtolower($text);
	  	if (empty($text)) {	
			return 'n-a';
	  	}
	  	return $text;
	}	
}