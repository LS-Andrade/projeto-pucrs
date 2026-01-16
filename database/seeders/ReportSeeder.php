<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        Report::factory()->count(10)->create([
            'created_by' => $users->random()->id,
            'status' => Report::STATUS_OPEN,
        ]);
    }
}
