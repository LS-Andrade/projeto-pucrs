<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdoptionStoreRequest;
use App\Http\Requests\AdoptionUpdateRequest;
use App\Models\Adoption;

class AdoptionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Adoption::class, 'adoption');
    }

    public function index()
    {
        return Adoption::with('animal', 'adopter')->orderBy('created_at', 'desc')->paginate(10);
    }

    public function myAdoptions()
    {
        return Adoption::where('adopter_id', auth()->id())
            ->with('animal', 'animal.organization')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function show(Adoption $adoption)
    {
        return $adoption->load('animal', 'adopter', 'followups');
    }

    public function store(AdoptionStoreRequest $request)
    {
        return Adoption::create([
            'animal_id' => $request->validated()['animal_id'],
            'adopter_id'=> auth()->id(),
            'motivation'=> $request->validated()['motivation'] ?? null,
            'status'    => 'pending',
            'created_by'=> auth()->id(),
            'updated_by'=> auth()->id(),
        ]);
    }

    public function update(AdoptionUpdateRequest $request, Adoption $adoption)
    {
        $adoption->update($request->validated());
        $adoption->updated_by = auth()->id();
        $adoption->save();

        return $adoption;
    }

    public function destroy(Adoption $adoption)
    {
        $adoption->delete();
        return response()->noContent();
    }
}
