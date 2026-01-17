<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportAttachmentStoreRequest;
use App\Http\Requests\ReportAttachmentUpdateRequest;
use App\Models\ReportAttachment;
use Illuminate\Support\Facades\Storage;

class ReportAttachmentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ReportAttachment::class, 'report_attachment');
    }

    public function index()
    {
        return ReportAttachment::with('report')->paginate();
    }

    public function show(ReportAttachment $report_attachment)
    {
        return $report_attachment->load('report');
    }

    public function store(ReportAttachmentStoreRequest $request)
    {
        $path = $request->file('file')->store('reports', 'public');

        $attachment = ReportAttachment::create([
            'report_id' => $request->validated()['report_id'],
            'file_path' => $path,
            'created_by'=> auth()->id(),
            'updated_by'=> auth()->id(),
        ]);

        return response()->json($attachment, 201);
    }

    public function update(ReportAttachmentUpdateRequest $request, ReportAttachment $report_attachment)
    {
        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($report_attachment->file_path);
            $report_attachment->file_path = $request->file('file')->store('reports', 'public');
        }

        $report_attachment->updated_by = auth()->id();
        $report_attachment->save();

        return $report_attachment;
    }

    public function destroy(ReportAttachment $report_attachment)
    {
        Storage::disk('public')->delete($report_attachment->file_path);
        $report_attachment->delete();

        return response()->noContent();
    }
}
