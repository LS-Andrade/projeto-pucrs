<?php

namespace Database\Factories;

use App\Models\EducationalContent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EducationalContentFactory extends Factory
{
    protected $model = EducationalContent::class;

    public function definition(): array
    {
        $title = fake()->sentence(4);

        return [
            'created_by' => User::factory()->admin(),
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => fake()->paragraphs(4, true),
            'is_published' => fake()->boolean(70),
        ];
    }
}
