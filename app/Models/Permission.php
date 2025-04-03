<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug'];

    public function roles()
{
    return $this->belongsToMany(Role::class, 'roles_permissions');
}

    public function admins()
    {
        return $this->belongsTomany(Admins::class,'admins_permission');
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'roles_permissions', 'permission_id', 'role_id')
            ->using(RolePermission::class)
            ->withTimestamps();
    }

}
