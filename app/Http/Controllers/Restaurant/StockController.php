<?php

namespace App\Http\Controllers\Restaurant;

use Log;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Category;
use App\Imports\StockImport;
use Illuminate\Http\Request;
use App\Exports\StockSampleExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;


class StockController extends Controller
{
    public function index(Request $request)
    {
        $stocks = Stock::with('category', 'product')->paginate(10);
       
        return view('Restaurant.stocks.index', compact('stocks'));
    }

  

    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()->route('restaurant.stocks.index')->with('success', 'Stock deleted successfully!');
    }

    public function updateBulk(Request $request)
    {
        
        $data = $request->input('stocks');

        if ($data) {
            foreach ($data as $id => $stockData) {
                $stock = Stock::find($id);

                if ($stock) {
                    $stock->update([
                        'default_stock' => $stockData['default_stock'] ?? $stock->default_stock,
                        'todays_stock' => $stockData['todays_stock'] ?? $stock->todays_stock,
                    ]);
                }
            }
            return redirect()->route('restaurant.stocks.index')->with('success', 'Stock updated successfully!');
        }

        return redirect()->route('restaurant.stocks.index')->with('error', 'No stock data provided.');
    }

    public function uploadBulk(Request $request)
    {  
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);
       
        try {
            Excel::import(new StockImport, $request->file('file'));
            return redirect()->route('restaurant.stocks.index')->with('success', 'Stocks updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Bulk Upload Error: ' . $e->getMessage());
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
        return view('restaurant.stocks.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'product_id' => 'required|exists:products,id',
            'default_stock' => 'required|integer|min:0',
            'todays_stock' => 'required|integer|min:0',
        ]);
    
        try {
            // Check if stock with same category and product exists
            $stock = Stock::updateOrCreate(
                [
                    'category_id' => $request->category_id,
                    'product_id' => $request->product_id,
                ],
                [
                    'default_stock' => $request->default_stock,
                    'todays_stock' => $request->todays_stock,
                ]
            );
    
            return redirect()->route('restaurant.stocks.index')->with('success', 'Stock entry added/updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    
}
