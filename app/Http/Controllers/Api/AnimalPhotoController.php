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

    /**
     * Listar fotos de animais
     * 
     * Retorna uma lista de fotos de animais.
     * 
     * @group Animais
     * @authenticated
     * 
     * @queryParam animal_id integer Filtrar por ID do animal. Example: 1
     * 
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "animal_id": 1,
     *       "photo": "animals/photo.jpg",
     *       "is_main": true,
     *       "animal": {}
     *     }
     *   ]
     * }
     */
    public function index()
    {
        $query = AnimalPhoto::with('animal');
        
        if (request('animal_id')) {
            $query->where('animal_id', request('animal_id'));
        }
        
        return $query->paginate();
    }

    /**
     * Exibir foto
     * 
     * Retorna detalhes de uma foto específica.
     * 
     * @group Animais
     * @authenticated
     * 
     * @urlParam animal_photo integer required ID da foto. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "photo": "animals/photo.jpg",
     *   "animal": {}
     * }
     */
    public function show(AnimalPhoto $animal_photo)
    {
        return $animal_photo->load('animal');
    }

    /**
     * Upload de foto
     * 
     * Faz upload de uma nova foto de animal.
     * 
     * @group Animais
     * @authenticated
     * 
     * @bodyParam animal_id integer required ID do animal. Example: 1
     * @bodyParam photo file required Arquivo da foto. 
     * @bodyParam is_main boolean Definir como foto principal. Example: false
     * 
     * @response 201 {
     *   "id": 1,
     *   "animal_id": 1,
     *   "photo": "animals/abc123.jpg",
     *   "is_main": false
     * }
     */
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

    /**
     * Atualizar foto
     * 
     * Atualiza uma foto ou suas configurações.
     * 
     * @group Animais
     * @authenticated
     * 
     * @urlParam animal_photo integer required ID da foto. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "is_main": true
     * }
     */
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

    /**
     * Excluir foto
     * 
     * Remove uma foto do animal.
     * 
     * @group Animais
     * @authenticated
     * 
     * @urlParam animal_photo integer required ID da foto. Example: 1
     * 
     * @response 204 {}
     */
    public function destroy(AnimalPhoto $animal_photo)
    {
        Storage::disk('public')->delete($animal_photo->photo);
        $animal_photo->delete();

        return response()->noContent();
    }
}
