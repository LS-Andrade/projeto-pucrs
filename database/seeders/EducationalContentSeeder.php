<?php

namespace Database\Seeders;

use App\Models\EducationalContent;
use App\Models\User;
use Illuminate\Database\Seeder;

class EducationalContentSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        EducationalContent::factory()->count(5)->create([
            'created_by' => $admin->id,
            'is_published' => true,
        ]);
    }
}
