<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportStoreRequest;
use App\Http\Requests\ReportUpdateRequest;
use App\Models\Report;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Report::class, 'report');
    }

    public function index()
    {
        return Report::with('reporter', 'assignee')->paginate();
    }

    public function show(Report $report)
    {
        return $report->load('reporter', 'assignee', 'attachments');
    }

    public function store(ReportStoreRequest $request)
    {
        return Report::create([
            ...$request->validated(),
            'reporter_id' => auth()->id(),
            'status'      => 'pending',
            'created_by'  => auth()->id(),
            'updated_by'  => auth()->id(),
        ]);
    }

    public function update(ReportUpdateRequest $request, Report $report)
    {
        $report->update($request->validated());
        $report->updated_by = auth()->id();
        $report->save();

        return $report;
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return response()->noContent();
    }
}
