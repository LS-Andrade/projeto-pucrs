<?php

namespace Database\Factories;

use App\Models\Content;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContentFactory extends Factory
{
    protected $model = Content::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1, 9999),
            'content' => $this->faker->paragraphs(5, true),
            'category_id' => Category::factory(),
            'published_at' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
            'author_id' => User::factory(),
            'is_active' => true,
            'created_by' => User::factory(),
            'updated_by' => null,
        ];
    }
}
