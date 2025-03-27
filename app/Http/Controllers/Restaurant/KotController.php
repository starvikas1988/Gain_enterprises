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
use Dompdf\Dompdf;
use Dompdf\Options;

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
        return view('Restaurant.kot', compact('categories', 'products', 'orderTypes', 'tables'));
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

        // Create order

        $order = new Order;
        $order->restaurant_id = $request->restaurant_id;
        $order->address_id = ($restaurantData->address ? $restaurantData->address : NULL);
        $order->order_type = $request->order_type;
        $order->created_by = 'WEB';
        $order->token_no = 'TKN' . strtoupper(uniqid());
        $order->table_id = ($request->table_id ? $request->table_id : NULL);
        $order->booking_platform = 'KOT';
        $order->payment_type = $request->payment_account;
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
            }
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
        return view('restaurant.token_pdf', [
            'order' => $order->first(),
            'groupedData' => $groupedData
        ]);
    }

    // public function generateToken($orderId)
    // {
    //     // Fetch order details using query builder
    //     $order = DB::table('orders')
    //         ->join('restaurants', 'orders.restaurant_id', '=', 'restaurants.id')
    //         ->leftJoin('restaurant_tablenumbers', 'orders.table_id', '=', 'restaurant_tablenumbers.id')
    //         ->leftJoin('order_items', 'orders.id', '=', 'order_items.order_id')
    //         ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
    //         ->select(
    //             'orders.*',
    //             'restaurants.name as restaurant_name',
    //             'restaurants.gst_percentage',
    //             'restaurants.gst_type',
    //             'restaurant_tablenumbers.table_number as table_number',
    //             'order_items.product_id',
    //             'order_items.quantity',
    //             'order_items.amount as item_amount',
    //             'products.name as product_name',
    //             'products.price as product_price'
    //         )
    //         ->where('orders.id', $orderId)
    //         ->get();

    //     if ($order->isEmpty()) {
    //         abort(404, 'Order not found');
    //     }

    //     // Group the data for easier use in the view
    //     $groupedData = $order->groupBy('product_id');

    //     // Configure PDF options
    //     $options = new Options();
    //     $options->set('defaultFont', 'Helvetica');
    //     $dompdf = new Dompdf($options);

    //     // Generate view
    //     $pdfView = view('restaurant.token_pdf', [
    //         'order' => $order->first(), 
    //         'groupedData' => $groupedData
    //     ])->render();

    //     $dompdf->loadHtml($pdfView);
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();

    //     // Download PDF
    //     return $dompdf->stream('Token_'.$order->first()->token_no.'.pdf');
    // }


}
