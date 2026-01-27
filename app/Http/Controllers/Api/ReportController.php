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
        return Report::with('reporter', 'assignedUser')->paginate();
    }

    public function show(Report $report)
    {
        return $report->load('reporter', 'assignedUser', 'attachments');
    }

    public function store(ReportStoreRequest $request)
    {
        $report = Report::create([
            ...$request->validated(),
            'reporter_id' => auth()->id(),
            'status'      => 'pending',
            'created_by'  => auth()->id(),
            'updated_by'  => auth()->id(),
        ]);

        return response()->json($report, 201);
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
