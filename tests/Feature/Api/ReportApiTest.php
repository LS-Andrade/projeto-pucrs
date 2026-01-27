<?php

namespace Tests\Feature\Api;

use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ReportApiTest extends TestCase
{
    use RefreshDatabase;

    private function validPayload(): array
    {
        return [
            'animal_description' => 'Animal em situacao de risco',
            'location' => 'Rua das Flores, 123',
            'city' => 'Porto Alegre',
            'state' => 'RS',
        ];
    }

    public function test_authenticated_user_can_create_report(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->postJson('/api/reports', $this->validPayload());

        $response->assertCreated()
            ->assertJsonPath('animal_description', 'Animal em situacao de risco');

        $this->assertDatabaseHas('reports', [
            'animal_description' => 'Animal em situacao de risco',
            'reporter_id' => $user->id,
        ]);
    }

    public function test_guest_cannot_create_report(): void
    {
        $this->postJson('/api/reports', $this->validPayload())
            ->assertUnauthorized();
    }

    public function test_user_without_permission_cannot_list_reports(): void
    {
        Sanctum::actingAs(User::factory()->create(['role' => 'user']));

        $this->getJson('/api/reports')
            ->assertForbidden();
    }

    public function test_admin_can_list_reports(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Report::factory()->count(2)->create();

        Sanctum::actingAs($admin);

        $response = $this->getJson('/api/reports');

        $response->assertOk()
            ->assertJsonStructure([
                'current_page',
                'data',
                'first_page_url',
                'last_page',
            ])
            ->assertJsonCount(2, 'data');
    }
}
