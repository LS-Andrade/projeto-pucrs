<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();

        Organization::factory(5)->create([
            'created_by' => $admin->id,
        ]);
    }
}
