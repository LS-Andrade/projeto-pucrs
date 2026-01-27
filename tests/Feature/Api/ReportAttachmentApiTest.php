<?php

namespace Tests\Feature\Api;

use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ReportAttachmentApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_upload_attachment(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $report = Report::factory()->create([
            'reporter_id' => $user->id,
            'created_by' => $user->id,
        ]);

        Sanctum::actingAs($user);

        $file = UploadedFile::fake()->create('photo.jpg', 100);

        $response = $this->postJson('/api/report-attachments', [
            'report_id' => $report->id,
            'file' => $file,
        ]);

        $response->assertCreated()
            ->assertJsonPath('report_id', $report->id);

        $this->assertDatabaseCount('report_attachments', 1);

        $storedPath = $response->json('file_path');
        $this->assertNotEmpty($storedPath);
        Storage::disk('public')->assertExists($storedPath);
    }

    public function test_guest_cannot_upload_attachment(): void
    {
        Storage::fake('public');

        $report = Report::factory()->create();

        $this->postJson('/api/report-attachments', [
            'report_id' => $report->id,
            'file' => UploadedFile::fake()->create('photo.jpg', 100),
        ])->assertUnauthorized();
    }

    public function test_upload_requires_file_and_report(): void
    {
        Storage::fake('public');

        Sanctum::actingAs(User::factory()->create());

        $this->postJson('/api/report-attachments', [
            'report_id' => null,
        ])->assertStatus(422);
    }
}
