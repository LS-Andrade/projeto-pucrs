<?php

namespace Database\Factories;

use App\Models\Adoption;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdoptionFactory extends Factory
{
    protected $model = Adoption::class;

    public function definition(): array
    {
        return [
            'animal_id' => Animal::factory(),
            'adopter_id' => User::factory(),
            'status' => $this->faker->randomElement([
                Adoption::STATUS_PENDING,
                Adoption::STATUS_APPROVED,
                Adoption::STATUS_REJECTED,
            ]),
            'motivation' => $this->faker->sentence(),
            'created_by' => User::factory(),
            'updated_by' => null,
        ];
    }
}
