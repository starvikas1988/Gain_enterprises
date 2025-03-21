<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DriverKyc extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'driver_kycs';
    protected $fillable = [];
    public function driver()
    {
        return $this->belongsTo(\App\Models\Driver::class, 'driver_id');
    }
}
