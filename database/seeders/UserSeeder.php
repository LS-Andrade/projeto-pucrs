<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'phone' => '11999999999',
            'role' => 'admin',
            'is_active' => true,
            'created_by' => null,
            'updated_by' => null,
        ]);

        User::factory(10)->create([
            'created_by' => $admin->id,
        ]);
    }
}
