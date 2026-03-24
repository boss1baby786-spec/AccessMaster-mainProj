<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin    = Role::firstOrCreate(['name' => 'super_admin']);
        $businessAdmin = Role::firstOrCreate(['name' => 'business_admin']);
        $cashier       = Role::firstOrCreate(['name' => 'cashier']);
        $customer      = Role::firstOrCreate(['name' => 'customer']);

        // super_admin ko saari permissions do
        $allPermissions = Permission::all();
        $superAdmin->syncPermissions($allPermissions);
    }
}
















//<!-- <//?php

// namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;
// use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Role;

// class RoleSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         //
//    $admin=Role::firstOrCreate(['name' => 'super_admin']);
//    Role::firstOrCreate(['name' => 'manager']);
//    Role::firstOrCreate(['name' => 'csr']);

//    $allPermissions=Permission::all();
//    $admin->syncPermissions($allPermissions);





//     }
    
// } 
