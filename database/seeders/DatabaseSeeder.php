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
            OrganizationUserSeeder::class,
            CategorySeeder::class,
            ContentSeeder::class,
            AnimalSeeder::class,
            AnimalPhotoSeeder::class,
            AdoptionSeeder::class,
            AdoptionFollowupSeeder::class,
            ReportSeeder::class,
            ReportAttachmentSeeder::class,
            AuditLogSeeder::class,
        ]);
    }
}
