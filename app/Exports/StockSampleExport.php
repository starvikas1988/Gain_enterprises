<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;

class StockSampleExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        // Header Row
        $data = [
            ['category_id', 'category_name', 'product_id', 'product_name', 'default_stock', 'todays_stock'],
        ];

        // Fetch Categories and Products
        $products = Product::with('category')->get();

        // Example Data
        foreach ($products as $product) {
            $data[] = [
                $product->category->id,
                $product->category->name,
                $product->id,
                $product->name,
                100, // Default Stock
                50,  // Today's Stock
            ];
        }

        return $data;
    }
}
