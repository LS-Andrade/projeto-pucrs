<?php

namespace Database\Seeders;

use App\Models\Adoption;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdoptionSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();
        $animals = Animal::all();
        $users = User::where('role', 'user')->get();

        foreach ($animals->random(min(10, $animals->count())) as $animal) {
            Adoption::factory()->create([
                'animal_id' => $animal->id,
                'adopter_id' => $users->random()->id,
                'created_by' => $admin->id,
            ]);
        }
    }
}
