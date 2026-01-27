<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

class EducationalContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_publish_content()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();

        Sanctum::actingAs($admin);

        $this->postJson('/api/contents', [
            'title' => 'Como cuidar de filhotes',
            'slug' => 'como-cuidar-de-filhotes',
            'content' => 'Conteudo educativo...',
            'category_id' => $category->id,
        ])->assertStatus(201);
    }

    public function test_regular_user_cannot_publish_content()
    {
        $user = User::factory()->create(['role' => 'user']);

        Sanctum::actingAs($user);

        $this->postJson('/api/contents', [
            'title' => 'Texto qualquer',
            'content' => 'Texto qualquer...'
        ])->assertStatus(403);
    }
}