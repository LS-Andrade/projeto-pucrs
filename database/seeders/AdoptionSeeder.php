<?php

namespace Database\Seeders;

use App\Models\Adoption;
use App\Models\User;
use App\Models\Animal;
use Illuminate\Database\Seeder;

class AdoptionSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $animals = Animal::all();

        foreach ($users as $user) {
            if ($animals->isEmpty()) break;

            $animal = $animals->shift();

            Adoption::factory()->create([
                'created_by' => $user->id,
                'animal_id' => $animal->id,
                'status' => Adoption::STATUS_PENDING,
            ]);
        }
    }
}
