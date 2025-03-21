<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mainpermission extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'mainpermission';
    protected $fillable = [
        'name',
		'position',
        'icon',
    ];	
	
	public function permission()
    {
        return $this->belongsTo(\App\Models\Permission::class, 'main_id');
    }
}
