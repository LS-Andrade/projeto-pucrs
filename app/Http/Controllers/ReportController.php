<?php
namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return Report::with('reporter', 'attachments')->paginate(15);
    }

    public function show(Report $report)
    {
        $this->authorize('view', $report);
        return $report->load('reporter', 'attachments');
    }

    public function storePublic(Request $request)
    {
        $data = $request->validate([
            'animal_description' => 'required|string',
            'location' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string|max:2',
        ]);

        $report = Report::create($data + ['status' => 'open']);

        return response()->json($report, 201);
    }

    public function update(Request $request, Report $report)
    {
        $this->authorize('update', $report);

        $data = $request->validate([
            'status' => 'in:open,assigned,resolved,dismissed'
        ]);

        $report->update($data);

        return response()->json($report);
    }

    public function assign(Report $report)
    {
        $this->authorize('assign', $report);

        $report->update([
            'assigned_to' => request()->user()->id,
            'status' => 'assigned'
        ]);

        return response()->json($report);
    }

    public function resolve(Report $report)
    {
        $this->authorize('resolve', $report);

        $report->update(['status' => 'resolved']);

        return response()->json($report);
    }

    public function dismiss(Report $report)
    {
        $this->authorize('dismiss', $report);

        $report->update(['status' => 'dismissed']);

        return response()->json($report);
    }
}