<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AuditLog;
use App\Models\User;

class AuditLogSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        AuditLog::factory()->count(50)->create([
            'user_id' => $users->random()->id,
        ]);
    }
}
