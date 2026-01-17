<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();

        Category::factory(6)->create([
            'created_by' => $admin->id,
        ]);
    }
}
