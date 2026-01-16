<?php
namespace Database\Factories;

use App\Models\ReportAttachment;
use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportAttachmentFactory extends Factory
{
    protected $model = ReportAttachment::class;

    public function definition(): array
    {
        return [
            'report_id' => Report::factory(),
            'file_path' => $this->faker->filePath(),
            'file_type' => $this->faker->mimeType(),
        ];
    }
}