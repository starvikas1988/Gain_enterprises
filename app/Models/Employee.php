<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use App\Notifications\EmployeeResetPasswordNotification;

class Employee extends Authenticatable implements CanResetPassword
{
    use HasFactory;
    //use HasRoles;

    use Notifiable;
    protected $guard = 'employee';
    
    protected $fillable = ['restaurant_id', 'name', 'email', 'password', 'status','role_id','permission_id'];
    protected $hidden = ['password', 'remember_token'];


    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'employee_roles');
    }

    public function permissions()
    {
        return $this->roles()->with('permissions');
    }

    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new EmployeeResetPasswordNotification($token));
    }
    
}
