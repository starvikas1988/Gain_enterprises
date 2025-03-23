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

    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()->route('restaurant.stocks.index')->with('success', 'Stock deleted successfully!');
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
}
