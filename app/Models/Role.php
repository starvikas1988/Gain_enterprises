<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug','status'];

    public function permissions()
    {
        return $this->belongsTomany(Permission::class,'roles_permissions');
    }

    public function admins()
    {
        return $this->belongsTomany(Admins::class,'admins_role');
    }
}
