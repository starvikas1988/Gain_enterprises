<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        $employee = Auth::guard('employee')->user();

        // Fetch orders based on the restaurant the employee belongs to
        $orders = DB::table('orders')
            ->where('restaurant_id', $employee->restaurant_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('employee.orders.index', compact('orders'));
    }
}
