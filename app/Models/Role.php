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

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_roles', 'role_id', 'employee_id');
    }
    
}
