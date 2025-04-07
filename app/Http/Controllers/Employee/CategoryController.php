<?php

namespace App\Http\Controllers\Employee;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $employee = auth()->guard('employee')->user();
        $restaurantId = $employee->restaurant_id;

        $query = Category::where('restaurant_id', $restaurantId);

        if ($request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $categories = $query->paginate(10);
        return view('employee.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('employee.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'restaurant_id' => 'required|exists:restaurants,id',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image file
            'status' => 'required|in:A,D',
        ]);
        
        
        // $employee = auth()->guard('employee')->user();
        // $restaurantId = $employee->restaurant_id; 

        $iconPath = null;
    
        // Handle image upload without using storage facade
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconName = time() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('uploads/category'), $iconName); // Store directly in public/uploads/category
            $iconPath = 'uploads/category/' . $iconName;
        }
    
        $category = new Category([
            'restaurant_id' => $request->restaurant_id,
            'name' => $request->name,
            'icon' => $iconPath,
            'status' => $request->status,
        ]);
    
        $category->save();

        $restaurantId = auth()->id(); // Restaurant ID
        // Insert into restaurant_categories table
        DB::table('restaurant_categories')->insert([
            'restaurant_id' => $restaurantId,
            'category_id' => $category->id,
            'status' => 'A', // Default to active
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->route('employee.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $employee = auth()->guard('employee')->user();
        $restaurantId = $employee->restaurant_id;
        $category = Category::where('restaurant_id', $restaurantId)->findOrFail($id);
        return view('employee.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $employee = auth()->guard('employee')->user();
        $restaurantId = $employee->restaurant_id;
        $category = Category::where('restaurant_id', $restaurantId)->findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:191',
            'restaurant_id' => 'required|exists:restaurants,id',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:A,D',
        ]);
       // dd($request->all());
        // Update name and status
        $category->name = $request->name;
        $category->restaurant_id = $request->restaurant_id;
        $category->status = $request->status;
    
        // Handle icon upload if provided
        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($category->icon && file_exists(public_path($category->icon))) {
                unlink(public_path($category->icon));
            }
    
            // Save new icon
            $icon = $request->file('icon');
            $iconName = time() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('uploads/category'), $iconName);
    
            $category->icon = 'uploads/category/' . $iconName;
        }
    
        $category->save();

        // Update or Insert into restaurant_categories table
        DB::table('restaurant_categories')->updateOrInsert(
            [
                'restaurant_id' => auth()->id(),
                'category_id' => $category->id,
            ],
            [
                'status' => 'A',
                'updated_at' => now(),
                'created_at' => now(), // Will be ignored if record already exists
            ]
        );
    
        return redirect()->route('employee.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $employee = auth()->guard('employee')->user();
        $restaurantId = $employee->restaurant_id;
        $category = Category::where('restaurant_id',$restaurantId)->findOrFail($id);
        
        // Check and delete the image from public/uploads/category/
        if ($category->icon && file_exists(public_path($category->icon))) {
            unlink(public_path($category->icon));
        }
        
        // Delete from restaurant_categories table
        DB::table('restaurant_categories')
        ->where('restaurant_id', Auth::id())
        ->where('category_id', $category->id)
        ->delete();

        $category->delete();
        
        return response()->json(['message' => 'Category deleted successfully']);
    }

}
