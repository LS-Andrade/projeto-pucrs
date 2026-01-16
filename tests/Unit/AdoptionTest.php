<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdoptionTest extends TestCase
{
    use RefreshDatabase;

    public function test_adoption_relationships()
    {
        $adoption = Adoption::factory()->create();

        $this->assertInstanceOf(Animal::class, $adoption->animal);
        $this->assertInstanceOf(User::class, $adoption->adopter);
    }
}
