<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Animal;
use App\Models\Adoption;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

class AdoptionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_request_adoption()
    {
        $user = User::factory()->create(['role' => 'user']);
        $animal = Animal::factory()->create(['status' => 'available']);

        Sanctum::actingAs($user);

        $this->postJson('/api/adoptions', [
            'animal_id' => $animal->id,
            'motivation' => 'Quero dar um lar responsavel.'
        ])->assertStatus(201);

        $this->assertDatabaseHas('adoptions', [
            'animal_id' => $animal->id,
            'adopter_id' => $user->id,
            'status' => 'pending',
        ]);
    }

    public function test_user_cannot_request_adoption_of_unavailable_animal()
    {
        $user = User::factory()->create(['role' => 'user']);
        $animal = Animal::factory()->create(['status' => 'adopted']);

        Sanctum::actingAs($user);

        $this->postJson('/api/adoptions', [
            'animal_id' => $animal->id,
        ])->assertStatus(422);
    }
}
