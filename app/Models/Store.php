<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'location',
        'email',
        'phone',
        'status',
    ];

     public function routes()
    {
        return $this->belongsToMany(Route::class)
            ->withPivot('stop_order')
            ->withTimestamps();
    }



}
