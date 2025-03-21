<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'transactions';
    protected $fillable = [];
    
    public function customer()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
	
	public function fromToUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'from_to');
    }
}
