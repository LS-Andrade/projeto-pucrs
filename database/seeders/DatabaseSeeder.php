<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            OrganizationSeeder::class,
            AnimalSeeder::class,
            AdoptionSeeder::class,
            ReportSeeder::class,
            EducationalContentSeeder::class,
            FeedbackSeeder::class,
        ]);
    }
}
