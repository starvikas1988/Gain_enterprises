<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'order_id',
        'product_id',
        'restaurant_id',
        'quantity',
        'amount',
        'total_amount',
    ];
    
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }
    
    public function restaurant()
    {
        return $this->belongsTo(\App\Models\Restaurant::class, 'restaurant_id');
    }
    
    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class, 'order_id');
    }
}
