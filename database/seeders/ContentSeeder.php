<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\User;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();

        Content::factory(12)->create([
            'created_by' => $admin->id,
        ]);
    }
}
