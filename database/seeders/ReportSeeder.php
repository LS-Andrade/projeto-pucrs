<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();

        Report::factory(15)->create([
            'created_by' => $admin->id,
        ]);
    }
}
