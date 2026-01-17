<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportStoreRequest;
use App\Models\Report;

class ReportController extends Controller
{
    public function create()
    {
        return view('reports.create');
    }

    public function store(ReportStoreRequest $request)
    {
        Report::create([
            ...$request->validated(),
            'reporter_id' => auth()->id(),
            'status' => 'pending',
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('home')->with('success', 'Denúncia enviada com sucesso!');
    }
}
