<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\ReportAttachment;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReportAttachmentSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();
        $reports = Report::all();

        foreach ($reports as $report) {
            ReportAttachment::factory(rand(0, 3))->create([
                'report_id' => $report->id,
                'created_by' => $admin->id,
            ]);
        }
    }
}
