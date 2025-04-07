<?php

namespace App\Http\Controllers\Employee;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PurchaseController extends Controller
{
    public function dineInPurchases(Request $request)
    {
       // $restaurantId = Auth::guard('restaurant')->id();
        $employee = auth()->guard('employee')->user();
        $restaurantId = $employee->restaurant_id;
        $query = Order::where('restaurant_id', $restaurantId)
            ->whereNotNull('table_id')
            ->where('payment_status', 'SUCCESS')
            ->orderBy('created_at', 'desc');
    
        // Search Filter
        if (!empty($request->search)) {
            $query->where('id', 'like', '%' . $request->search . '%');
        }
    
        // Date Filter (Only Apply if Both Dates are Present)
        if (!empty($request->start_date) && !empty($request->end_date)) {
            $query->whereDate('created_at', '>=', $request->start_date)
                  ->whereDate('created_at', '<=', $request->end_date);
        } elseif (!empty($request->start_date)) {
            $query->whereDate('created_at', '>=', $request->start_date);
        } elseif (!empty($request->end_date)) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
    
        $orders = $query->paginate(10);
        return view('employee.purchases.dine_in', compact('orders'));
    }
    

    public function homeDeliveryPurchases(Request $request)
    {
        $employee = auth()->guard('employee')->user();
        $restaurantId = $employee->restaurant_id;
        $query = Order::where('restaurant_id', $restaurantId)
            ->whereNull('table_id')
            ->where('payment_status', 'SUCCESS')
            ->orderBy('created_at', 'desc');

        // Search Filter
        if ($request->has('search')) {
            $query->where('id', 'like', '%' . $request->search . '%');
        }

        // Date Filter
        if (!empty($request->start_date) && !empty($request->end_date)) {
            $query->whereDate('created_at', '>=', $request->start_date)
                  ->whereDate('created_at', '<=', $request->end_date);
        } elseif (!empty($request->start_date)) {
            $query->whereDate('created_at', '>=', $request->start_date);
        } elseif (!empty($request->end_date)) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $orders = $query->paginate(10);
        return view('employee.purchases.home_delivery', compact('orders'));
    }

     // Edit Purchase (For both Dine-In and Delivery)

     public function edit($id)
    {
        $employee = auth()->guard('employee')->user();
        $restaurantId = $employee->restaurant_id;

        // Fix: No need to call id() on an integer
        $order = Order::where('restaurant_id', $restaurantId)->findOrFail($id);

        return view('employee.purchases.edit', compact('order'));
    }


     // Update Purchase (For both Dine-In and Delivery)
     public function update(Request $request, $id)
     {
         $request->validate([
             'table_id' => 'nullable|integer',
             'total_amount' => 'required|numeric',
         ]);
     
         $employee = auth()->guard('employee')->user();
         $restaurantId = $employee->restaurant_id;
     
         // Fix: Remove ->id() because $restaurantId is already an integer
         $order = Order::where('restaurant_id', $restaurantId)->findOrFail($id);
     
         $order->table_id = $request->table_id;
         $order->total_amount = $request->total_amount;
         $order->save();
     
         return redirect()->route($order->table_id ? 'employee.purchases.dine_in' : 'employee.purchases.home_delivery')
             ->with('success', 'Purchase updated successfully');
     }
     

    
    // Delete Purchase (For both Dine-In and Delivery)
    public function destroy($id)
    {
        $employee = auth()->guard('employee')->user();
        $restaurantId = $employee->restaurant_id;

        // Fix: Remove ->id() because $restaurantId is already an integer
        $order = Order::where('restaurant_id', $restaurantId)->findOrFail($id);
        
        $order->delete();

        return redirect()->route($order->table_id ? 'employee.purchases.dine_in' : 'employee.purchases.home_delivery')
            ->with('success', 'Purchase deleted successfully');
    }

}
