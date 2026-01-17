<?php

namespace Database\Factories;

use App\Models\ReportAttachment;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportAttachmentFactory extends Factory
{
    protected $model = ReportAttachment::class;

    public function definition(): array
    {
        return [
            'report_id' => Report::factory(),
            'file_path' => 'reports/' . $this->faker->uuid() . '.jpg',
            'created_by' => User::factory(),
            'updated_by' => null,
        ];
    }
}
