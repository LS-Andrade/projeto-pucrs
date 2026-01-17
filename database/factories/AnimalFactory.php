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
        $birthDate = $this->faker->dateTimeBetween('-10 years', '-1 month');

        return [
            'name' => $this->faker->firstName(),
            'species' => $this->faker->randomElement(['dog', 'cat', 'bird', 'rabbit']),
            'breed' => $this->faker->word(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'birth_date' => $birthDate,
            'age' => now()->diffInYears($birthDate),
            'size' => $this->faker->randomElement(['small', 'medium', 'large']),
            'color' => $this->faker->safeColorName(),
            'description' => $this->faker->paragraph(),
            'is_castrated' => $this->faker->boolean(),
            'is_vaccinated' => $this->faker->boolean(),
            'health_status' => $this->faker->randomElement(['healthy', 'under treatment', 'special needs']),
            'status' => 'available',
            'organization_id' => Organization::factory(),
            'created_by' => User::factory(),
            'updated_by' => null,
        ];
    }
}
