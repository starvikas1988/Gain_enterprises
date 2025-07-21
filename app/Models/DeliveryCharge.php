<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryCharge extends Model
{
    use HasFactory;
     protected $table = 'delivery_charges';
     protected $fillable = [
        'min_order_amount',
        'max_order_amount',
        'delivery_fee',
        'distance_km',
        'restaurant_id',
        'status',
    ];
}
