<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnimalPhotoStoreRequest;
use App\Http\Requests\AnimalPhotoUpdateRequest;
use App\Models\AnimalPhoto;
use Illuminate\Support\Facades\Storage;

class AnimalPhotoController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(AnimalPhoto::class, 'animal_photo');
    }

    public function index()
    {
        $query = AnimalPhoto::with('animal');
        
        if (request('animal_id')) {
            $query->where('animal_id', request('animal_id'));
        }
        
        return $query->paginate();
    }

    public function show(AnimalPhoto $animal_photo)
    {
        return $animal_photo->load('animal');
    }

    public function store(AnimalPhotoStoreRequest $request)
    {
        $path = $request->file('photo')->store('animals', 'public');

        $photo = AnimalPhoto::create([
            'animal_id'  => $request->validated()['animal_id'],
            'photo'      => $path,
            'is_main'    => $request->validated()['is_main'] ?? false,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return response()->json($photo, 201);
    }

    public function update(AnimalPhotoUpdateRequest $request, AnimalPhoto $animal_photo)
    {
        if ($request->hasFile('photo')) {
            Storage::disk('public')->delete($animal_photo->photo);
            $animal_photo->photo = $request->file('photo')->store('animals', 'public');
        }

        if ($request->has('is_main')) {
            $animal_photo->is_main = $request->validated()['is_main'];
        }

        $animal_photo->updated_by = auth()->id();
        $animal_photo->save();

        return $animal_photo;
    }

    public function destroy(AnimalPhoto $animal_photo)
    {
        Storage::disk('public')->delete($animal_photo->photo);
        $animal_photo->delete();

        return response()->noContent();
    }
}
