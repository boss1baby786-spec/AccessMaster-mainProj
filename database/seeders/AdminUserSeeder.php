<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'  => 'Super Admin',
                'email' => 'admin@example.com',
                'role'  => 'super_admin',
            ],
            [
                'name'  => 'Business Admin',
                'email' => 'business@example.com',
                'role'  => 'business_admin',
            ],
            [
                'name'  => 'Cashier User',
                'email' => 'cashier@example.com',
                'role'  => 'cashier',
            ],
            [
                'name'  => 'Customer User',
                'email' => 'customer@example.com',
                'role'  => 'customer',
            ],
        ];

        foreach ($users as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name'              => $data['name'],
                    'password'          => Hash::make('password123'),
                    'status'            => 'active',
                    'email_verified_at' => now(),
                ]
            );

            $user->syncRoles([$data['role']]);
        }
    }
}