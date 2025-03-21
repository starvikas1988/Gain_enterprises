<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::where('restaurant_id', Auth::id());

        if ($request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $categories = $query->paginate(10);
        return view('Restaurant.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('Restaurant.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image file
            'status' => 'required|in:A,D',
        ]);
    
        $iconPath = null;
    
        // Handle image upload without using storage facade
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconName = time() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('uploads/category'), $iconName); // Store directly in public/uploads/category
            $iconPath = 'uploads/category/' . $iconName;
        }
    
        $category = new Category([
            'restaurant_id' => auth()->id(),
            'name' => $request->name,
            'icon' => $iconPath,
            'status' => $request->status,
        ]);
    
        $category->save();
    
        return redirect()->route('restaurant.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::where('restaurant_id', Auth::id())->findOrFail($id);
        return view('Restaurant.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::where('restaurant_id', Auth::id())->findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:191',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:A,D',
        ]);
    
        // Update name and status
        $category->name = $request->name;
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
    
        return redirect()->route('restaurant.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::where('restaurant_id', Auth::id())->findOrFail($id);
        
        // Check and delete the image from public/uploads/category/
        if ($category->icon && file_exists(public_path($category->icon))) {
            unlink(public_path($category->icon));
        }

        $category->delete();
        
        return response()->json(['message' => 'Category deleted successfully']);
    }

}
