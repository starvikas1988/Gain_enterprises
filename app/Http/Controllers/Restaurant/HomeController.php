<?php

namespace App\Http\Controllers\Restaurant;
use Auth;
use Hash;
use App\Models\Order;
use App\Models\Stock;
use App\Models\OrderItem;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:restaurant');
    }

    public function index()
    {
        $restaurantId = Auth::user()->id;
        $orderCount = Order::where('restaurant_id', $restaurantId)->count();
        
        // Fetch KOT Orders
        $kotOrders = Order::where('restaurant_id', $restaurantId)
        ->whereNotNull('table_id')
        ->orderBy('created_at', 'desc')
        ->get();


        // Fetch Web Orders (booking_platform != KOT)
        $webOrders = Order::where('restaurant_id', $restaurantId)
        ->whereNull('table_id')
        ->orderBy('created_at', 'desc')
        ->get();

           // Calculate today's overall stock count
           $totalTodayStock = Stock::where('restaurant_id', $restaurantId)
           ->where(function ($query) {
               $query->whereDate('updated_at', Carbon::today())
                     ->whereColumn('updated_at', '>', 'created_at');
           })
           ->orWhere(function ($query) {
               $query->whereDate('created_at', Carbon::today())
                     ->whereColumn('updated_at', '<=', 'created_at');
           })
           ->sum('todays_stock');

          // Calculate total purchase count (from successful orders)
        $totalPurchaseCount = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
        ->where('orders.restaurant_id', $restaurantId)
        ->where('orders.payment_status', 'SUCCESS')
        ->sum('order_items.quantity');

        // $webOrders = Order::whereNull('booking_platform')
        // ->whereNull('restaurant_id')
        // ->orderBy('created_at', 'desc')
        // ->get();

        return view('Restaurant.dashboard', compact('orderCount','kotOrders', 'webOrders','totalTodayStock','totalPurchaseCount'));
    }

    public function myprofile()
    {
        $user = Restaurant::find(Auth::guard('restaurant')->id());
        return view('Restaurant.myprofile')->with(['user' => $user]);
    }

    public function changepassword()
    {
        return view('Restaurant.changepassword');
    }

    public function passwordchange(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $user = Auth::guard('restaurant')->user();

        if (!Hash::check($request->get('current_password'), $user->password)) {
            return redirect()->back()->withErrors("Your current password does not match.");
        }

        Restaurant::find($user->id)->update(['password' => Hash::make($request->new_password)]);
        return redirect()->back()->withSuccess('Password changed successfully');
    }

    public function updateprofile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'Name is required',
        ]);

        if ($validator->fails()) {
            return redirect(route('restaurant.myprofile'))->withErrors($validator)->withInput();
        }

        $restaurant = Restaurant::find(Auth::guard('restaurant')->id());
        $restaurant->name = $request->name;
        $restaurant->address = $request->address;
        $restaurant->save();

        return redirect(route('restaurant.myprofile'))->withSuccess('Profile updated successfully');
    }

    public function updateOrderStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'order_status' => 'required|in:Pending,Processing,Completed',
            'payment_status' => 'required|in:Pending,SUCCESS,Failed',
        ]);

        $order = Order::findOrFail($request->order_id);
        $order->order_status = $request->order_status;
        $order->payment_status = $request->payment_status;
        $order->save();

        return response()->json(['success' => true, 'message' => 'Order status updated successfully']);
    }

    public function changeOrderStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'order_status' => 'required|in:Pending,Processing,Completed',
            'payment_status' => 'nullable|in:Pending,SUCCESS,Failed',
        ]);

        $order = Order::findOrFail($request->order_id);
        $order->order_status = $request->order_status;

        // Update payment status only if applicable (Cash or UPI)
        if (in_array($order->payment_type, ['cash', 'upi']) && $request->payment_status) {
            $order->payment_status = $request->payment_status;
        }

        $order->save();

        return response()->json(['success' => true, 'message' => 'Order status updated successfully']);
    }


}
