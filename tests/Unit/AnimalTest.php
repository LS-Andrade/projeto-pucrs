<?php 
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Animal;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnimalTest extends TestCase
{
    use RefreshDatabase;

    public function test_animal_default_status_is_available()
    {
        $animal = Animal::factory()->create();
        $this->assertEquals('available', $animal->status);
    }
}