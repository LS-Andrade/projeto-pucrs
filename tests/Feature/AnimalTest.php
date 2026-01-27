<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Animal;
use App\Models\Organization;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

class AnimalTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_animal()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $organization = Organization::factory()->create();
        $organization->users()->attach($user->id);

        Sanctum::actingAs($user);

        $this->postJson('/api/animals', [
            'name' => 'Rex',
            'species' => 'dog',
            'gender' => 'male',
            'status' => 'available',
            'organization_id' => $organization->id,
        ])->assertStatus(201);
    }

    public function test_guest_cannot_create_animal()
    {
        $this->postJson('/api/animals', [
            'name' => 'Rex',
            'species' => 'dog',
            'gender' => 'male'
        ])->assertStatus(401);
    }
}
