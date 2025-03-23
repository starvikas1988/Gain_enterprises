<?php

namespace App\Imports;

use App\Models\Stock;
use App\Models\Category;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StockImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Validate category_id and product_id existence
        $category = Category::find($row['category_id']);
        $product = Product::find($row['product_id']);

        if (!$category || !$product) {
            throw new \Exception("Invalid Category ID or Product ID for Row: " . json_encode($row));
        }

        // Insert or update stock data
        return Stock::updateOrCreate(
            [
                'category_id' => $row['category_id'],
                'product_id' => $row['product_id'],
            ],
            [
                'default_stock' => $row['default_stock'],
                'todays_stock' => $row['todays_stock'],
            ]
        );
    }
}
