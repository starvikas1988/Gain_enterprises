<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    
    use HasFactory, SoftDeletes;
    
    protected $fillable = ['name', 'icon', 'status', 'restaurant_id'];
    
    public function getImageAttribute($value)
    {
        return 'https://caterer.gainenterprises.in/backend/' . $value;
    }

    
}