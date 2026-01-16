<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_report_relationships()
    {
        $report = Report::factory()->create();

        $this->assertInstanceOf(User::class, $report->reporter);
    }
}
