<?php

namespace App\Http\Controllers\Employee;

use Log;
use Auth;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Category;
use App\Imports\StockImport;
use Illuminate\Http\Request;
use App\Exports\StockSampleExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index(Request $request)
    {
        $employee = Auth::guard('employee')->user();
        $restaurantId = $employee->restaurant_id;
        $today = Carbon::today();

        // Fetch today's stock for the logged-in employee's restaurant
        $stocks = Stock::with('category', 'product')
            ->where('restaurant_id', $restaurantId)
            ->whereDate('created_at', $today)
            ->paginate(10);
        
        return view('employee.stocks.index', compact('stocks'));
    }

    public function destroy($id)
    {
        $employee = Auth::guard('employee')->user();
        $restaurantId = $employee->restaurant_id;

        $stock = Stock::where('id', $id)->where('restaurant_id', $restaurantId)->firstOrFail();
        $stock->delete();

        return redirect()->route('employee.stocks.index')->with('success', 'Stock deleted successfully!');
    }

    public function updateBulk(Request $request)
    {
        $data = $request->input('stocks');
        $employee = Auth::guard('employee')->user();
        $restaurantId = $employee->restaurant_id;

        if ($data) {
            foreach ($data as $id => $stockData) {
                $stock = Stock::where('id', $id)
                              ->where('restaurant_id', $restaurantId)
                              ->first();

                if ($stock) {
                    $stock->update([
                        'default_stock' => $stockData['default_stock'] ?? $stock->default_stock,
                        'todays_stock' => $stockData['todays_stock'] ?? $stock->todays_stock,
                    ]);
                }
            }
            return redirect()->route('employee.stocks.index')->with('success', 'Stock updated successfully!');
        }

        return redirect()->route('employee.stocks.index')->with('error', 'No stock data provided.');
    }

    public function uploadBulk(Request $request)
    {  
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        $employee = Auth::guard('employee')->user();
        $restaurantId = $employee->restaurant_id;

        try {
            Excel::import(new StockImport($restaurantId), $request->file('file'));
            return redirect()->route('employee.stocks.index')->with('success', 'Stocks updated successfully!');
        } catch (\Exception $e) {
            Log::error('Bulk Upload Error: ' . $e->getMessage());
            return back()->with('error', 'Error uploading file: ' . $e->getMessage());
        }
    }

    public function downloadSample()
    {
        return Excel::download(new StockSampleExport, 'stock_sample.xlsx');
    }

    public function getProductsByCategory($categoryId)
    {
        $products = Product::where('category_id', $categoryId)->get(['id', 'name']);

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found'], 404);
        }

        return response()->json($products);
    }

    public function create()
    {
        $categories = Category::where('status', 'A')->get();
        return view('employee.stocks.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'product_id' => 'required|exists:products,id',
            'default_stock' => 'required|integer|min:0',
            'todays_stock' => 'required|integer|min:0',
        ]);

        $employee = Auth::guard('employee')->user();
        $restaurantId = $employee->restaurant_id;
        $today = now()->toDateString();

        try {
            // Check if stock with the same category, product, and restaurant exists and was created today
            $stock = Stock::where('restaurant_id', $restaurantId)
                ->where('category_id', $request->category_id)
                ->where('product_id', $request->product_id)
                ->whereDate('created_at', $today)
                ->first();

            if ($stock) {
                // Update existing stock for today
                $stock->update([
                    'default_stock' => $request->default_stock,
                    'todays_stock' => $request->todays_stock,
                ]);

                return redirect()->route('employee.stocks.index')->with('success', 'Stock updated successfully!');
            } else {
                // Create a new stock entry
                Stock::create([
                    'restaurant_id' => $restaurantId,
                    'category_id' => $request->category_id,
                    'product_id' => $request->product_id,
                    'default_stock' => $request->default_stock,
                    'todays_stock' => $request->todays_stock,
                ]);

                return redirect()->route('employee.stocks.index')->with('success', 'New stock entry created successfully!');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function todaysStock(Request $request)
    {
        $employee = Auth::guard('employee')->user();
        $restaurantId = $employee->restaurant_id;

        $stocks = Stock::select(
            'stocks.id',
            'stocks.category_id',
            'stocks.product_id',
            'stocks.todays_stock',
            'categories.name as category_name',
            'products.name as product_name',
            DB::raw('COALESCE(SUM(order_items.quantity), 0) as sold_quantity'),
            DB::raw('(stocks.todays_stock - COALESCE(SUM(order_items.quantity), 0)) as remaining_stock')
        )
        ->leftJoin('products', 'stocks.product_id', '=', 'products.id')
        ->leftJoin('categories', 'stocks.category_id', '=', 'categories.id')
        ->leftJoin('order_items', function ($join) use ($restaurantId) {
            $join->on('products.id', '=', 'order_items.product_id')
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->where('orders.restaurant_id', $restaurantId)
                ->where('orders.payment_status', 'SUCCESS')
                ->whereDate('orders.created_at', Carbon::today());
        })
        ->where(function ($query) {
            $query->where(function ($q) {
                $q->whereDate('stocks.updated_at', Carbon::today())
                  ->whereColumn('stocks.updated_at', '>', 'stocks.created_at');
            })
            ->orWhere(function ($q) {
                $q->whereDate('stocks.created_at', Carbon::today())
                  ->whereColumn('stocks.updated_at', '<=', 'stocks.created_at');
            });
        })
        ->groupBy('stocks.id', 'stocks.category_id', 'stocks.product_id', 'stocks.todays_stock', 'categories.name', 'products.name')
        ->paginate(10);

        return view('employee.stocks.todays_stock', compact('stocks'));
    }
}
