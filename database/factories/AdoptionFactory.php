<?php

namespace Database\Factories;

use App\Models\Adoption;
use App\Models\User;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdoptionFactory extends Factory
{
    protected $model = Adoption::class;

    public function definition(): array
    {
        return [
            'created_by' => User::factory(),
            'animal_id' => Animal::factory(),
            'status' => Adoption::STATUS_PENDING,
            'message' => fake()->sentence(),
        ];
    }
}
