<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Websiteconfig extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'websiteconfigs';
    protected $fillable = [];
    
}
