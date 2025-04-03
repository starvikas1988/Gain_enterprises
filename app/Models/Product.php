<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name',
        'category_id',
        'restaurant_id',
        'price',
        'image',
        'description',
        'is_recommend',
        'status'
    ];
    
    public function getImageAttribute($value)
    {
        return 'https://caterer.gainenterprises.in/backend/' . $value;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    
}