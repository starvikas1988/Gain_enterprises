<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

       protected $fillable = ['driver_id', 'route_id', 'started_at', 'completed_at', 'admin_status', 'driver_status'];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'trip_store')
                    ->withPivot(['sequence', 'arrival_time', 'load_time', 'departure_time'])
                    ->withTimestamps()
                    ->orderBy('pivot_sequence');
    }
}
