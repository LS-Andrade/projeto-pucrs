<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Animal;
use App\Models\Adoption;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdoptionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_request_adoption()
    {
        $user = User::factory()->create(['role' => 'adopter']);
        $animal = Animal::factory()->create(['status' => 'available']);

        $this->actingAs($user)->postJson('/api/adoptions', [
            'animal_id' => $animal->id,
            'motivation' => 'Quero dar um lar responsável.'
        ])->assertStatus(201);

        $this->assertDatabaseHas('adoptions', [
            'animal_id' => $animal->id,
            'adopter_id' => $user->id,
            'status' => 'pending',
        ]);
    }

    public function test_user_cannot_request_adoption_of_unavailable_animal()
    {
        $user = User::factory()->create(['role' => 'adopter']);
        $animal = Animal::factory()->create(['status' => 'adopted']);

        $this->actingAs($user)->postJson('/api/adoptions', [
            'animal_id' => $animal->id,
        ])->assertStatus(422);
    }
}
