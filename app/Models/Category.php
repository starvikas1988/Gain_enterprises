<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'restaurant_id',
        'name',
        'icon',
        'status',
    ];
    
    public function getIconAttribute($value)
    {
        return 'https://caterer.gainenterprises.in/backend/' . $value;
    }
    
    public function restaurants()
    {
        return $this->hasMany(RestaurantCategory::class);
    }
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
