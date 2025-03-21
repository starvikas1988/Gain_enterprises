<?php

namespace App\Http\Controllers\Restaurant;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:restaurant');
    }
    public function index(Request $request) {
        $restaurantId = Auth::user()->id;
    
        $query = Order::where('restaurant_id', $restaurantId);
        $restaurant = Restaurant::where('id', $restaurantId)->get()->first();
       // dd($restaurantName->name);
    
        // Apply Filters
        if ($request->has('order_id') && $request->order_id != '') {
            $query->where('id', $request->order_id);
        }
    
        if ($request->has('payment_status') && $request->payment_status != '') {
            $query->where('payment_status', $request->payment_status);
        }
    
        if ($request->has('date') && $request->date != '') {
            $query->whereDate('created_at', $request->date);
        }
    
        // Use paginate instead of get
        $orders = $query->orderBy('created_at', 'desc')->paginate(10);
    
        return view('Restaurant.orders', compact('orders','restaurant'));
    }

    public function show($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);

        return view('Restaurant.partials.order-details', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'Order deleted successfully']);
    }

    
  
}
