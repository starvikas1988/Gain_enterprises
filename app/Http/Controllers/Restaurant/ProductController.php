<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Display a listing of products
    public function index(Request $request)
    {
        $restaurantId = Auth::user()->id;

        // Fetch categories for filter dropdown
        $categories = Category::where('restaurant_id', $restaurantId)->get();

        // Product Query
        $query = Product::whereHas('category', function ($q) use ($restaurantId) {
            $q->where('restaurant_id', $restaurantId);
        });

        // Apply Filters
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('Restaurant.products.index', compact('products', 'categories'));
    }

    // Show the form for creating a new product
    public function create()
    {
        $restaurantId = Auth::user()->id;
        $categories = Category::where('restaurant_id', $restaurantId)->get();

        return view('Restaurant.products.create', compact('categories'));
    }

    // Store a newly created product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:1',
            'description' => 'nullable|string',
            'is_recommend' => 'nullable|string|in:YES,NO',
            'status' => 'required|in:A,D',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Handle image upload
       
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/product'), $imageName); // Ensure correct path
            $data['image'] = 'public/uploads/product/' . $imageName; // Store relative path
        }  

        Product::create($data);

        return redirect()->route('restaurant.products.index')->with('success', 'Product created successfully!');
    }

    // Show the form for editing the specified product
    public function edit($id)
    {
        $restaurantId = Auth::user()->id;
        $product = Product::where('id', $id)->whereHas('category', function ($q) use ($restaurantId) {
            $q->where('restaurant_id', $restaurantId);
        })->firstOrFail();

        $categories = Category::where('restaurant_id', $restaurantId)->get();

        return view('Restaurant.products.edit', compact('product', 'categories'));
    }

    // Update the specified product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:1',
            'description' => 'nullable|string',
            'is_recommend' => 'nullable|string|in:YES,NO',
            'status' => 'required|in:A,D',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $data = $request->except('image');
    
        // Handle image update with renamed image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/product'), $imageName); // Ensure correct path
            $data['image'] = 'public/uploads/product/' . $imageName; // Store relative path
        }        
       
       
        $product->update($data);
    
        return redirect()->route('restaurant.products.index')->with('success', 'Product updated successfully!');
    }
    

    // Remove the specified product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully!']);
    }
}
