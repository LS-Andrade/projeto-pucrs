<?php
namespace Database\Factories;

use App\Models\AnimalPhoto;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnimalPhotoFactory extends Factory
{
    protected $model = AnimalPhoto::class;

    public function definition(): array
    {
        return [
            'animal_id' => Animal::factory(),
            'photo_path' => $this->faker->imageUrl(640, 480, 'animals', true),
            'is_main' => $this->faker->boolean(30),
        ];
    }
}