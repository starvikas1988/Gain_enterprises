<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adminsettlement extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'adminsettlements';
    protected $fillable = [
        'id',
		'user_id',
		'wallet_type',
		'vendor_id',
        'ammount',
        'txn_type',
        'txn_date',
        'message',
    ];
    
    public function customer()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
    
    public function vendor()
    {
        return $this->belongsTo(\App\Models\Vendor::class, 'vendor_id');
    }
}
