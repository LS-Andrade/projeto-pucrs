<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrganizationUserSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $organizations = Organization::all();
        $admin = User::first();

        foreach ($organizations as $organization) {
            $organization->users()->attach(
                $users->random(rand(2, 5))->pluck('id')->toArray(),
                ['created_by' => $admin->id]
            );
        }
    }
}
