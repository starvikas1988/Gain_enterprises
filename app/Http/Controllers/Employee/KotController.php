<?php

namespace App\Http\Controllers\Employee;

use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;

class KotController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index()
    {
        $employee = auth()->guard('employee')->user();
        $restaurantId = $employee->restaurant_id; // Employee's assigned restaurant

        $categories = Category::where('restaurant_id', $restaurantId)->get();
        $products = Product::where('restaurant_id', $restaurantId)->get();
        $orderTypes = DB::table('order_types')->get();
        $tables = DB::table('restaurant_tablenumbers')
            ->where('restaurant_id', $restaurantId)
            ->get();

        return view('employee.kot', compact('categories', 'products', 'orderTypes', 'tables'));
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

        if (!$couponData) {
            return response()->json(['success' => false, 'errorcode' => '03', 'message' => 'Invalid coupon code!', 'data' => []], 200);
        }

        $today = date('Y-m-d');
        if ($couponData->start_date > $today) {
            return response()->json(['success' => false, 'errorcode' => '03', 'message' => 'Coupon code not valid for today!', 'data' => []], 200);
        }
        if ($couponData->end_date < $today) {
            return response()->json(['success' => false, 'errorcode' => '03', 'message' => 'Coupon code expired!', 'data' => []], 200);
        }
        if ($totalAmount < $couponData->required_amount) {
            return response()->json([
                'success' => false,
                'errorcode' => '03',
                'message' => 'Required amount ₹' . ($couponData->required_amount - $totalAmount) . ' more to apply this coupon!',
                'data' => []
            ], 200);
        }

        return response()->json([
            'success' => true,
            'errorcode' => '00',
            'message' => 'Coupon applied successfully.',
            'data' => [['discountAmount' => round(($totalAmount * $couponData->discount_percentage / 100), 2), 'description' => $couponData->description]]
        ], 200);
    }

    private function verifyCouponKot($code, $totalAmount)
    {
        $couponData = Coupon::where('code', $code)
            ->where('status', 'A')
            ->first();
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

    public function placeOrder(Request $request)
    {
        $employee = auth()->guard('employee')->user();
        //dd($employee);
        $restaurantId = $employee->restaurant_id;

        $request->validate([
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

        $restaurantData = Restaurant::find($restaurantId);
        $totalAmount = 0;
        $totalGst = 0;

        foreach ($cartItems as $item) {
            $product = Product::where('id', $item['product_id'])->where('status', 'A')->first();
            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Invalid product.'], 400);
            }

            $amount = $product->price * $item['quantity'];
            $gstAmount = $restaurantData->gst_type === 'Including'
                ? $amount - ($amount / (1 + ($restaurantData->gst_percentage / 100)))
                : $amount * ($restaurantData->gst_percentage / 100);

            $totalAmount += $amount;
            $totalGst += $gstAmount;
        }

        $discountAmount = 0;
        $couponCode = null;
        if ($request->coupon_code) {
            $couponData = Coupon::where('code', $request->coupon_code)->first();
            if ($couponData) {
                $discountAmount = round(($totalAmount * $couponData->discount_percentage / 100), 2);
                $couponCode = $request->coupon_code;
            }
        }

        $order = Order::create([
            'restaurant_id' => $restaurantId,
            'order_type' => $request->order_type,
            'created_by' => 'WEB',
            'token_no' => 'TKN' . strtoupper(uniqid()),
            'table_id' => $request->table_id,
            'booking_platform' => 'KOT',
            'payment_type' => $request->payment_account,
            'total_amount' => $totalAmount - $discountAmount,
            'total_discount' => $discountAmount,
            'coupon_code' => $couponCode,
            'coupon_amount' => $discountAmount,
            'total_tax' => $totalGst,
            'gst_type' => $restaurantData->gst_type,
            'gst_percentage' => $restaurantData->gst_percentage,
            'cgst' => $totalGst / 2,
            'sgst' => $totalGst / 2,
            'order_status' => 'Pending',
            'payment_status' => 'Pending',
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'restaurant_id' => $restaurantId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'amount' => Product::find($item['product_id'])->price,
                'total_amount' => Product::find($item['product_id'])->price * $item['quantity']
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Order placed successfully!', 'order_id' => $order->id]);
    }

    public function generateToken($orderId)
    {
        // Fetch order details using query builder
        $order = DB::table('orders')
            ->join('restaurants', 'orders.restaurant_id', '=', 'restaurants.id')
            ->leftJoin('restaurant_tablenumbers', 'orders.table_id', '=', 'restaurant_tablenumbers.id')
            ->leftJoin('order_items', 'orders.id', '=', 'order_items.order_id')
            ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
            ->select(
                'orders.*',
                'restaurants.name as restaurant_name',
                'restaurants.gst_percentage',
                'restaurants.gst_type',
                'restaurant_tablenumbers.table_number as table_number',
                'order_items.product_id',
                'order_items.quantity',
                'order_items.amount as item_amount',
                'products.name as product_name',
                'products.price as product_price'
            )
            ->where('orders.id', $orderId)
            ->get();

        if ($order->isEmpty()) {
            abort(404, 'Order not found');
        }

        // Group data
        $groupedData = $order->groupBy('product_id');

        // Return the view directly for printing
        return view('employee.token_pdf', [
            'order' => $order->first(),
            'groupedData' => $groupedData
        ]);
    }
}
