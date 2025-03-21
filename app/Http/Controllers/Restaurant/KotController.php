<?php

namespace App\Http\Controllers\Restaurant;

use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Restaurant;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KotController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:restaurant');
    }

    public function index()
    {
        $restaurantId = auth()->user()->id;
        $categories = Category::all();
        $products = Product::all();
        $orderTypes = DB::table('order_types')->get();
        $tables = DB::table('restaurant_tablenumbers')
                ->where('restaurant_id', $restaurantId)
                ->get();
        return view('Restaurant.kot', compact('categories', 'products','orderTypes','tables'));
    }

    public function getProductsByCategory(Request $request)
    {
        if ($request->category_id) {
            $products = Product::where('category_id', $request->category_id)->get();
        } else {
            $products = Product::all(); // Show all products if no category is selected
        }


        return response()->json($products);
    }

    public function verifyCoupon(Request $request)
    {
        $code = $request->code;
        $totalAmount = $request->totalAmount;
        $couponData = Coupon::where('code', $code)
            ->where('status', 'A')
            ->first();
        //  dd($couponData);
        if ($couponData) {
            $today = date('Y-m-d');
            if ($couponData->start_date <= $today) {
                if ($couponData->end_date >= $today) {
                    if ($totalAmount >= $couponData->required_amount) {
                        $data = [
                            'discountAmount' => round(($totalAmount * $couponData->discount_percentage / 100), 2),
                            'description' => $couponData->description,
                        ];
                        return response()->json(['success' => true, 'errorcode' => '00', 'message' => 'Coupon applied successfully.', 'data' => [$data]], 200);
                    } else
                        return response()->json(['success' => false, 'errorcode' => '03', 'message' => 'Required amount ₹' . ($couponData->required_amount - $totalAmount) . ' more to cart for apply this coupon!', 'data' => array()], 200);
                } else
                    return response()->json(['success' => false, 'errorcode' => '03', 'message' => 'Coupon code expired!', 'data' => array()], 200);
            } else
                return response()->json(['success' => false, 'errorcode' => '03', 'message' => 'Coupon code not valid for today!', 'data' => array()], 200);
        } else
            return response()->json(['success' => false, 'errorcode' => '03', 'message' => 'Invalid coupon code!', 'data' => array()], 200);
    }

    private function verifyCouponKot($code, $totalAmount)
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

    public function place_order(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'total_amount' => 'required|numeric|min:1',
            'payment_account' => 'required|in:cash,upi',
            'cart_items' => 'required',
            'coupon_code' => 'nullable|string',
            'coupon_amount' => 'nullable|numeric',
            'total_discount' => 'nullable|numeric',
            'payment_note' => 'nullable|string'
        ]);

        $cartItems = json_decode($request->cart_items, true);

        if (empty($cartItems)) {
            return response()->json(['success' => false, 'message' => 'Cart is empty.'], 400);
        }

        $totalAmount = 0;
        $totalGst = 0;


        $restaurantData = Restaurant::where('id', $request->restaurant_id)->first();
        foreach ($cartItems as $item) {

            $productData = Product::where('id', $item['product_id'])->where('status', 'A')->first();

            $amount = $productData->price * $item['quantity'];
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
        if ($request->coupon_code) {
            $code = $request->coupon_code;
            $resp = $this->verifyCouponKot($code, $totalAmount);
            $couponData = $resp->getData();
            if ($couponData->success == true) {
                $couponCode = $code;
                $discountAmount = $couponData->data[0]->discountAmount;
            }
        }
       

        // if($request->orderType == 'Delivery')
        // {
        //     $addressData = UserAddress::where('user_id', $userId)
        //         ->where('id', $request->addressId)
        //         ->count();
        //     if($addressData == 0)
        //         return response()->json(['success' => false,'errorcode'=>'03', 'message'=>'Invalid address id!', 'data'=>array()], 200); 
        // }

        // Create order

        $order = new Order;
        $order->restaurant_id = $request->restaurant_id;
        $order->address_id = ($restaurantData->address ? $restaurantData->address : NULL);
        $order->order_type = $request->order_type;
        $order->created_by = 'WEB';
        $order->table_id = ($request->table_id ? $request->table_id : NULL);
        $order->booking_platform='KOT';
        $order->payment_type=$request->payment_account;
        $order->total_amount = $totalAmount - $discountAmount;
        $order->total_discount = $discountAmount;
        $order->coupon_code = $couponCode;
        $order->coupon_amount = $discountAmount;
        $order->total_tax = $totalGst;
        $order->gst_type = $restaurantData->gst_type;
        $order->gst_percentage = $gstPercentage;
        $order->cgst = $totalGst / 2;
        $order->sgst = $totalGst / 2;
        $order->order_status = 'Pending';
        $order->payment_status = 'Pending';
        $order->created_at = date('Y-m-d H:i:s');
        $order->updated_at = date('Y-m-d H:i:s');
        $order->save();
        // $order = Order::create([
        //     'restaurant_id' => $request->restaurant_id,
        //     'total_amount' => $request->total_amount,
        //     'payment_account' => $request->payment_account,
        //     'payment_note' => $request->payment_note,
        //     'coupon_code' => $request->coupon_code,
        //     'coupon_amount' => $request->coupon_amount,
        //     'total_discount' => $request->total_discount,
        //     'status' => 'Pending'
        // ]);

        // Save order items

        if ($order->id) {
            foreach ($cartItems as $item) {
                $productData = Product::where('id', $item['product_id'])->where('status', 'A')->first();
                $amount = $productData->price;

                $orderItem = new OrderItem;
                $orderItem->order_id = $order->id;
                $orderItem->restaurant_id =  $request->restaurant_id;
                $orderItem->product_id = $item['product_id'];
                $orderItem->quantity = $item['quantity'];
                $orderItem->amount = $amount;
                $orderItem->total_amount = $amount * $item['quantity'];
                $orderItem->created_at = date('Y-m-d H:i:s');
                $orderItem->updated_at = date('Y-m-d H:i:s');
                $orderItem->save();

                // OrderItem::create([
                //     'order_id' => $order->id,
                //     'restaurant_id' => $request->restaurant_id,
                //     'product_id' => $item['product_id'],
                //     'quantity' => $item['quantity'],
                //     'price' => $item['amount']
                // ]);
            }
        }


        return response()->json(['success' => true, 'message' => 'Order placed successfully!']);
    }
}
