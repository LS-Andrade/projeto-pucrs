<?php 
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_report()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->postJson('/api/reports', [
            'animal_description' => 'Cachorro abandonado em frente ao mercado',
            'location' => 'Rua Central, 123',
            'city' => 'São Paulo',
            'state' => 'SP',
        ])->assertStatus(201);
    }

    public function test_guest_cannot_create_report()
    {
        $this->postJson('/api/reports', [
            'animal_description' => 'Gato ferido',
            'location' => 'Rua A, 456',
            'city' => 'Campinas',
            'state' => 'SP',
        ])->assertStatus(401);
    }
}