<?php

namespace Database\Seeders;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Database\Seeder;

class AuditLogSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();
        $users = User::all();

        foreach ($users as $user) {
            AuditLog::factory(rand(3, 6))->create([
                'user_id' => $user->id,
                'created_by' => $admin->id,
            ]);
        }
    }
}
