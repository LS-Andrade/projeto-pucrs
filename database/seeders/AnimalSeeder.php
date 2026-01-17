<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();
        $organizations = Organization::all();

        foreach ($organizations as $organization) {
            Animal::factory(rand(5, 10))->create([
                'organization_id' => $organization->id,
                'created_by' => $admin->id,
            ]);
        }
    }
}
