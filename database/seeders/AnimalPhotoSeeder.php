<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\AnimalPhoto;
use App\Models\User;
use Illuminate\Database\Seeder;

class AnimalPhotoSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();
        $animals = Animal::all();

        foreach ($animals as $animal) {
            AnimalPhoto::factory(rand(1, 4))->create([
                'animal_id' => $animal->id,
                'created_by' => $admin->id,
            ]);
        }
    }
}
