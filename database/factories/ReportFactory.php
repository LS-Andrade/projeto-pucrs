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
            'created_by' => User::factory(),
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'location' => fake()->address(),
            'status' => Report::STATUS_OPEN,
        ];
    }
}
