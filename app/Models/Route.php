<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'driver_id'];

     public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class)
            ->withPivot('stop_order')
            ->withTimestamps()
            ->orderBy('pivot_stop_order');
    }
}
