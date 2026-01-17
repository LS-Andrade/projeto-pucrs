<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    protected $model = Report::class;

    public function definition(): array
    {
        return [
            'reporter_id' => User::factory(),
            'animal_description' => $this->faker->paragraph(),
            'location' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->stateAbbr(),
            'status' => $this->faker->randomElement(['open', 'in_progress', 'resolved']),
            'assigned_to' => $this->faker->optional()->randomElement([User::factory()]),
            'created_by' => User::factory(),
            'updated_by' => null,
        ];
    }
}
