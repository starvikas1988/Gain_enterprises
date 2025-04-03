<?php
namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\RestaurantTablenumber;

class RestaurantTablenumberController extends Controller
{
    public function index(Request $request)
    {
        // Get the logged-in employee's restaurant
        $restaurantId = auth()->guard('employee')->user()->restaurant_id;

        $query = RestaurantTablenumber::where('restaurant_id', $restaurantId);

        // Filter by Table ID
        if ($request->filled('table_id')) {
            $query->where('id', $request->table_id);
        }

        // Filter by Status
        if ($request->filled('table_status')) {
            $query->where('status', $request->table_status);
        }

        // Filter by Created Date
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Paginate with 10 results per page
        $tables = $query->paginate(10);

        return view('Employee.tables.index', compact('tables'));
    }

    public function create()
    {
        return view('Employee.tables.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_number' => 'required|unique:restaurant_tablenumbers,table_number',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:Available,Occupied,Reserved',
        ]);

        // Get the logged-in employee's restaurant
        $restaurantId = auth()->guard('employee')->user()->restaurant_id;

        RestaurantTablenumber::create([
            'restaurant_id' => $restaurantId,
            'table_number' => $request->table_number,
            'capacity' => $request->capacity,
            'status' => $request->status,
        ]);

        return redirect()->route('employee.tables.index')->with('success', 'Table created successfully!');
    }

    public function edit($id)
    {
        // Get the logged-in employee's restaurant
        $restaurantId = auth()->guard('employee')->user()->restaurant_id;

        $table = RestaurantTablenumber::where('restaurant_id', $restaurantId)->findOrFail($id);
        return view('Employee.tables.edit', compact('table'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'table_number' => 'required|string|max:50',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:Available,Occupied,Reserved',
        ]);

        // Get the logged-in employee's restaurant
        $restaurantId = auth()->guard('employee')->user()->restaurant_id;

        $table = RestaurantTablenumber::where('restaurant_id', $restaurantId)->findOrFail($id);
        $table->update($request->only('table_number', 'capacity', 'status'));

        return redirect()->route('employee.tables.index')->with('success', 'Table updated successfully!');
    }

    public function destroy($id)
    {
        // Get the logged-in employee's restaurant
        $restaurantId = auth()->guard('employee')->user()->restaurant_id;

        $table = RestaurantTablenumber::where('restaurant_id', $restaurantId)->findOrFail($id);
        $table->delete();

        return redirect()->route('employee.tables.index')->with('success', 'Table deleted successfully!');
    }
}
?>