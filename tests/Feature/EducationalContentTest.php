<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EducationalContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_publish_content()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->postJson('/api/contents', [
            'title' => 'Como cuidar de filhotes',
            'content' => 'Conteúdo educativo...'
        ])->assertStatus(201);
    }

    public function test_regular_user_cannot_publish_content()
    {
        $user = User::factory()->create(['role' => 'adopter']);

        $this->actingAs($user)->postJson('/api/contents', [
            'title' => 'Texto qualquer',
            'content' => 'Texto qualquer...'
        ])->assertStatus(403);
    }
}