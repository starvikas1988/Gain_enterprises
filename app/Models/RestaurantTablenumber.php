<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantTablenumber extends Model
{
    use HasFactory;

    protected $table = 'restaurant_tablenumbers';

    protected $fillable = [
        'restaurant_id',
        'table_number',
        'capacity',
        'status',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
