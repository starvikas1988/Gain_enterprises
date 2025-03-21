<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminCharge extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'admin_charges';
    protected $fillable = [
        'id',
		'user_id',
		'user_code',
		'transaction_id',
		'transaction_amount',
        'admin_charge',
        'charge_amount',        
    ];
    
    public function customer()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
