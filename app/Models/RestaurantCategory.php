<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantCategory extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [];
    
    public function restaurant()
    {
        return $this->belongsTo(\App\Models\Restaurant::class, 'restaurant_id');
    }
    
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }
    
}
