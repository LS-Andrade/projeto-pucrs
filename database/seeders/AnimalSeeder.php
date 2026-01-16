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
        $organizations = Organization::all();
        $users = User::all();

        foreach ($organizations as $organization) {
            Animal::factory()->count(5)->create([
                'organization_id' => $organization->id,
                'created_by' => $users->random()->id,
                'status' => Animal::STATUS_AVAILABLE,
            ]);
        }
    }
}
