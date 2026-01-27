<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnimalStoreRequest;
use App\Http\Requests\AnimalUpdateRequest;
use App\Models\Animal;

class AnimalController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Animal::class, 'animal');
    }

    public function index()
    {
        return Animal::with('organization', 'photos')->paginate();
    }

    public function show(Animal $animal)
    {
        return $animal->load('organization', 'photos');
    }

    public function store(AnimalStoreRequest $request)
    {
        $animal = Animal::create($request->validated());

        return response()->json($animal, 201);
    }

    public function update(AnimalUpdateRequest $request, Animal $animal)
    {
        $animal->update($request->validated());
        return $animal;
    }

    public function destroy(Animal $animal)
    {
        $animal->delete();
        return response()->noContent();
    }
}
