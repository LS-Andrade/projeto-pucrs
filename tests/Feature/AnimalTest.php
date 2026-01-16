<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Animal;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnimalTest extends TestCase
{
    use RefreshDatabase;

    public function test_protector_can_create_animal()
    {
        $user = User::factory()->create(['role' => 'protector']);

        $this->actingAs($user)->postJson('/api/animals', [
            'name' => 'Rex',
            'species' => 'dog',
            'gender' => 'male',
            'organization_id' => $user->organizations()->first()?->id ?? null,
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