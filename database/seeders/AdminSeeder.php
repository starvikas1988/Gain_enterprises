<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::insert([
            ['name'=>'Admin','email'=>'admin@gmail.com','mobile'=>'1234567890','password'=>bcrypt('password')],
            ['name'=>'Kishor Mondal','email'=>'kishore@gmail.com','mobile'=>'1234567890','password'=>bcrypt('password')],
            ['name'=>'Manish Yadav','email'=>'manish@gmail.com','mobile'=>'7412567875','password'=>bcrypt('password')],
            ['name'=>'Santanu Bhattarchaya','email'=>'santanu@gmail.com','mobile'=>'7412567875','password'=>bcrypt('password')],
            ['name'=>'Subodh Shaw','email'=>'subodh@gmail.com','mobile'=>'7412567875','password'=>bcrypt('password')],
            ['name'=>'Molay Kolay','email'=>'molay@gmail.com','mobile'=>'7412567875','password'=>bcrypt('password')],
        ]); 

        $role = Role::insert([
            ['name'=>'Admin','slug'=>'admin'],
            ['name'=>'Sub admin','slug'=>'subadmin'],
            ['name'=>'Marketing','slug'=>'author'],
        ]);

        $permission = Permission::insert([
            ['name'=>'Users','slug'=>'users'],
            ['name'=>'Add User','slug'=>'add-user'],
            ['name'=>'Edit User','slug'=>'edit-user'],
            ['name'=>'Delete User','slug'=>'delete-user'],
            ['name'=>'Roles','slug'=>'roles'],
            ['name'=>'Add Role','slug'=>'add-role'],
            ['name'=>'Edit Role','slug'=>'edit-role'],
            ['name'=>'Delete Role','slug'=>'delete-role'],
            ['name'=>'Permissions','slug'=>'permissions'],
            ['name'=>'Add Permission','slug'=>'add-permission'],
            ['name'=>'Edit Permission','slug'=>'edit-permission'],
            ['name'=>'Delete Permission','slug'=>'delete-permission'],
            ['name'=>'Courses','slug'=>'courses'],
            ['name'=>'Add Course','slug'=>'add-course'],
            ['name'=>'Edit Course','slug'=>'edit-course'],
            ['name'=>'Delete Course','slug'=>'delete-course'],
            ['name'=>'Members','slug'=>'members'],
            ['name'=>'Add Member','slug'=>'add-member'],
            ['name'=>'Edit Member','slug'=>'edit-member'],
            ['name'=>'Delete Member','slug'=>'delete-member'],
        ]);

        // Assign Role 
        Admin::whereId(1)->first()->roles()->attach([1]);
        Admin::whereId(2)->first()->roles()->attach([2]);
        Admin::whereId(3)->first()->roles()->attach([3]);
        Admin::whereId(4)->first()->roles()->attach([3]);
        Admin::whereId(5)->first()->roles()->attach([3]);
        Admin::whereId(6)->first()->roles()->attach([3]);

        // Role has Permission
        Role::whereId(1)->first()->permissions()->attach([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]);
        Role::whereId(2)->first()->permissions()->attach([13,14,15,16,17,18,19,20]);
        Role::whereId(3)->first()->permissions()->attach([13,14,15,16,17,18,19,20]);
    }
}
