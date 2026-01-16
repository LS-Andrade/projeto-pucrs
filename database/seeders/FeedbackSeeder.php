<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::whereIn('role', ['adopter', 'protector'])->get();

        Feedback::factory()->count(8)->create([
            'user_id' => $users->random()->id,
        ]);
    }
}
