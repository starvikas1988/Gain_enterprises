<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index(Request $request)
    {
        $employee = Auth::guard('employee')->user();
        $restaurantId = $employee->restaurant_id;
        
        $restaurant = Restaurant::where('id', $restaurantId)->first();
        if (!$restaurant) {
            return redirect()->route('employee.dashboard')->with('error', 'Restaurant not found.');
        }

        // Fetch orders with filters
        $orders = Order::where('restaurant_id', $restaurantId)
            ->when($request->order_id, fn($query, $order_id) => $query->where('id', $order_id))
            ->when($request->payment_status, fn($query, $payment_status) => $query->where('payment_status', $payment_status))
            ->when($request->date, fn($query, $date) => $query->whereDate('created_at', $date))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('employee.orders', compact('orders', 'restaurant'));
    }

    public function show(Request $request,$id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        $employeePermissions = session('employeePermissions', []);
       // dd($employeePermissions);
        return view('employee.partials.order-details', compact('order','employeePermissions'));
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
