<?php

namespace Database\Seeders;

use App\Models\Adoption;
use App\Models\AdoptionFollowup;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdoptionFollowupSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();
        $adoptions = Adoption::all();

        foreach ($adoptions as $adoption) {
            AdoptionFollowup::factory(rand(1, 3))->create([
                'adoption_id' => $adoption->id,
                'created_by' => $admin->id,
            ]);
        }
    }
}
