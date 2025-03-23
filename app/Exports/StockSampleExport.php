<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;

class StockSampleExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        return [
            ['category_id', 'product_id', 'default_stock', 'todays_stock'],
            ['1', '1', '100', '50'], // Example Data
            ['2', '3', '100', '30'],
        ];
    }
}
