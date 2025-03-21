<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'restaurant_id',
        'order_type',
        'booking_platform',
        'address_id',
        'created_by',
        'total_amount',
        'total_tax',
        'gst_percentage',
        'gst_type',
        'cgst',
        'sgst',
        'total_discount',
        'coupon_amount',
        'coupon_code',
        'order_status',
        'payment_status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    
    public function customer()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
    
    public function address()
    {
        return $this->belongsTo(\App\Models\UserAddress::class, 'address_id');
    }

    public function orderItems()
    {
        return $this->hasMany(\App\Models\OrderItem::class);
    }
    
    /**
     * Relationship with Creator (Optional if applicable)
     */
    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

}
