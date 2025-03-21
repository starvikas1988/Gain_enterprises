<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Restaurant extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'image',
        'rating',
        'availability',
        'gst_percentage',
        'gst_type',
        'status',
        'password',
        'address',
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];

    protected $casts = [
        'rating' => 'float',
        'gst_percentage' => 'integer',
        'availability' => 'string',
        'status' => 'string',
    ];

    public function getImageAttribute($value)
    {
        // return 'https://caterer.gainenterprises.in/backend/' . $value;
        return $value ? asset($value) : asset('backend/default.png');
    }
    
    


    public function categories()
    {
        return $this->hasMany(RestaurantCategory::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
