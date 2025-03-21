<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\RestaurantTablenumber;

class RestaurantTablenumberController extends Controller
{
   

    public function index(Request $request)
    {
        $query = RestaurantTablenumber::where('restaurant_id', Auth::id());

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

        return view('Restaurant.tables.index', compact('tables'));
    }

    public function create()
    {
        return view('Restaurant.tables.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_number' => 'required|unique:restaurant_tablenumbers,table_number',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:Available,Occupied,Reserved',
        ]);

        RestaurantTablenumber::create([
            'restaurant_id' => Auth::id(),
            'table_number' => $request->table_number,
            'capacity' => $request->capacity,
            'status' => $request->status,
        ]);

        return redirect()->route('restaurant.tables.index')->with('success', 'Table created successfully!');
    }


    public function edit($id)
    {
        $table = RestaurantTablenumber::where('restaurant_id', Auth::id())->findOrFail($id);
        return view('Restaurant.tables.edit', compact('table'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'table_number' => 'required|string|max:50',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:Available,Occupied,Reserved',
        ]);
    
        $table = RestaurantTablenumber::where('restaurant_id', Auth::id())->findOrFail($id);
        $table->update($request->only('table_number', 'capacity', 'status'));
    
        return redirect()->route('restaurant.tables.index')->with('success', 'Table updated successfully!');
    }

    public function destroy($id)
    {
        $table = RestaurantTablenumber::findOrFail($id);
        $table->delete();
        return redirect()->route('restaurant.tables.index')->with('success', 'Table deleted successfully!');
    }
}
