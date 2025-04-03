<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
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
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $this->command->info('Permissions seeded successfully!');
    }
}
