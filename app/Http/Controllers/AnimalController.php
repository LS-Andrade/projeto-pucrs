<?php
namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\AnimalPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimalController extends Controller
{
    public function index()
    {
        return Animal::with('photos', 'organization')->paginate(15);
    }

    public function show(Animal $animal)
    {
        return $animal->load('photos', 'organization');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Animal::class);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|in:dog,cat,other',
            'breed' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female',
            'age' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'organization_id' => 'required|exists:organizations,id'
        ]);

        $animal = Animal::create($data);

        return response()->json($animal, 201);
    }

    public function update(Request $request, Animal $animal)
    {
        $this->authorize('update', $animal);

        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'species' => 'sometimes|in:dog,cat,other',
            'breed' => 'nullable|string|max:255',
            'gender' => 'sometimes|in:male,female',
            'age' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'sometimes|in:available,pending,adopted,unavailable'
        ]);

        $animal->update($data);

        return response()->json($animal);
    }

    public function destroy(Animal $animal)
    {
        $this->authorize('delete', $animal);

        $animal->delete();

        return response()->json(['message' => 'Animal removido']);
    }

    public function uploadPhoto(Request $request, Animal $animal)
    {
        $this->authorize('update', $animal);

        $request->validate([
            'photo' => 'required|image|max:2048'
        ]);

        $path = $request->file('photo')->store('animals', 'public');

        $photo = $animal->photos()->create([
            'path' => $path,
            'is_primary' => false
        ]);

        return response()->json($photo, 201);
    }

    public function deletePhoto(Animal $animal, AnimalPhoto $photo)
    {
        $this->authorize('update', $animal);

        Storage::disk('public')->delete($photo->path);
        $photo->delete();

        return response()->json(['message' => 'Foto removida']);
    }
}