<?php
namespace Database\Factories;

use App\Models\AdoptionFollowup;
use App\Models\Adoption;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdoptionFollowupFactory extends Factory
{
    protected $model = AdoptionFollowup::class;

    public function definition(): array
    {
        return [
            'adoption_id' => Adoption::factory(),
            'notes' => $this->faker->paragraph(),
            'visit_date' => $this->faker->date(),
            'created_by' => User::factory(),
        ];
    }
}
