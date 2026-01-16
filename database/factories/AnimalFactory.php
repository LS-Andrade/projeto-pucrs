<?php

namespace Database\Factories;

use App\Models\Animal;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnimalFactory extends Factory
{
    protected $model = Animal::class;

    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'species' => fake()->randomElement(['dog', 'cat']),
            'breed' => fake()->word(),
            'gender' => fake()->randomElement(['male', 'female']),
            'size' => fake()->randomElement(['small', 'medium', 'large']),
            'description' => fake()->paragraph(),
            'is_vaccinated' => fake()->boolean(),
            'is_castrated' => fake()->boolean(),
            'status' => Animal::STATUS_AVAILABLE,
            'organization_id' => Organization::factory(),
            'created_by' => User::factory(),
        ];
    }
}
