<?php

namespace App\Imports;

use App\Models\Stock;
use App\Models\Category;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;
use Carbon\Carbon;

class StockImport implements ToModel, WithHeadingRow
{
    protected $restaurantId;

    // Constructor to accept restaurant_id
    public function __construct($restaurantId)
    {
        $this->restaurantId = $restaurantId;
        \Log::info('Restaurant ID Passed: ' . $this->restaurantId);
    }


    public function model(array $row)
    {
        // Ensure required fields exist and ignore unnecessary columns
        if (!isset($row['category_id'], $row['product_id'], $row['default_stock'], $row['todays_stock'])) {
            throw new \Exception("Missing required fields in Row: " . json_encode($row));
        }

        // Validate category_id and product_id existence
        $category = Category::find($row['category_id']);
        $product = Product::find($row['product_id']);

        if (!$category || !$product) {
            throw new \Exception("Invalid Category ID or Product ID for Row: " . json_encode($row));
        }

        $today = Carbon::today();
       // dd($restaurantId);
         // Check if a stock exists for the same restaurant, category, product, and created today
         $stock = Stock::where('restaurant_id', $this->restaurantId)
         ->where('category_id', $row['category_id'])
         ->where('product_id', $row['product_id'])
         ->whereDate('created_at', $today)
         ->first();

         if ($stock) {
            // Update if it's the same day
            $stock->update([
                'default_stock' => $row['default_stock'],
                'todays_stock' => $row['todays_stock'],
            ]);
            return $stock;
        } else {
            // Create a new stock entry if it's a different day
            return new Stock([
                'restaurant_id' => $this->restaurantId,
                'category_id' => $row['category_id'],
                'product_id' => $row['product_id'],
                'default_stock' => $row['default_stock'],
                'todays_stock' => $row['todays_stock'],
            ]);
        }
        // Insert or update stock data
        // return Stock::updateOrCreate(
        //     [
        //         'restaurant_id' => $this->restaurantId,
        //         'category_id' => $row['category_id'],
        //         'product_id' => $row['product_id'],
        //     ],
        //     [
        //         'restaurant_id' => $this->restaurantId,
        //         'default_stock' => $row['default_stock'],
        //         'todays_stock' => $row['todays_stock'],
        //     ]
        // );
    }
}
