<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdoptionFollowupStoreRequest;
use App\Http\Requests\AdoptionFollowupUpdateRequest;
use App\Models\AdoptionFollowup;

class AdoptionFollowupController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(AdoptionFollowup::class, 'adoption_followup');
    }

    public function index()
    {
        return AdoptionFollowup::with('adoption')->paginate();
    }

    public function show(AdoptionFollowup $adoption_followup)
    {
        return $adoption_followup->load('adoption');
    }

    public function store(AdoptionFollowupStoreRequest $request)
    {
        return AdoptionFollowup::create([
            'adoption_id' => $request->validated()['adoption_id'],
            'notes'       => $request->validated()['notes'],
            'visit_date'  => $request->validated()['visit_date'],
            'created_by'  => auth()->id(),
            'updated_by'  => auth()->id(),
        ]);
    }

    public function update(AdoptionFollowupUpdateRequest $request, AdoptionFollowup $adoption_followup)
    {
        $adoption_followup->update($request->validated());
        $adoption_followup->updated_by = auth()->id();
        $adoption_followup->save();

        return $adoption_followup;
    }

    public function destroy(AdoptionFollowup $adoption_followup)
    {
        $adoption_followup->delete();
        return response()->noContent();
    }
}
