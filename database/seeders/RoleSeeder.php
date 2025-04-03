<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
   
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();

        // Create Roles
        $roles = [
            'Restaurant Admin' => $permissions->pluck('name'),
            'Manager' => [
                'view_dashboard',
                'view_kot_orders',
                'view_all_orders',
                'view_dine_in_purchases',
                'view_delivery_purchases',
                'manage_tables',
                'manage_categories',
                'manage_products',
                'manage_stocks',
                'view_todays_stocks',
                'view_profile',
                'logout',
            ],
            'Chef' => [
                'view_kot_orders',
                'view_todays_stocks',
                'view_profile',
                'logout',
            ],
            'Waiter' => [
                'view_kot_orders',
                'view_dine_in_purchases',
                'view_profile',
                'logout',
            ],
            'Cashier' => [
                'view_all_orders',
                'view_delivery_purchases',
                'view_dine_in_purchases',
                'view_profile',
                'logout',
            ],
            'Stock Manager' => [
                'manage_stocks',
                'view_todays_stocks',
                'view_profile',
                'logout',
            ],
            'Delivery Boy' => [
                'view_delivery_purchases',
                'view_profile',
                'logout',
            ],
        ];

        // Create and Assign Permissions
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);

            $role->syncPermissions($rolePermissions);
        }

        $this->command->info('Roles and permissions assigned successfully!');
    }
}
