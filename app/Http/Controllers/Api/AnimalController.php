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

    /**
     * Listar todos os animais
     * 
     * Retorna uma lista paginada de todos os animais disponíveis para adoção.
     * 
     * @group Animais
     * @unauthenticated
     * 
     * @queryParam page integer Número da página. Example: 1
     * @queryParam per_page integer Itens por página. Example: 15
     * 
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "Rex",
     *       "species": "dog",
     *       "breed": "Labrador",
     *       "age": 3,
     *       "size": "large",
     *       "status": "available",
     *       "organization": {
     *         "id": 1,
     *         "name": "ONG Amigos dos Animais"
     *       },
     *       "photos": []
     *     }
     *   ],
     *   "links": {...},
     *   "meta": {...}
     * }
     */
    public function index()
    {
        return Animal::with('organization', 'photos')->paginate();
    }

    /**
     * Exibir detalhes de um animal
     * 
     * Retorna informações detalhadas de um animal específico.
     * 
     * @group Animais
     * @unauthenticated
     * 
     * @urlParam animal integer required ID do animal. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "name": "Rex",
     *   "species": "dog",
     *   "breed": "Labrador",
     *   "age": 3,
     *   "organization": {
     *     "id": 1,
     *     "name": "ONG Amigos dos Animais"
     *   },
     *   "photos": [
     *     {"id": 1, "url": "https://exemplo.com/foto.jpg"}
     *   ]
     * }
     * 
     * @response 404 {
     *   "message": "Animal not found"
     * }
     */
    public function show(Animal $animal)
    {
        return $animal->load('organization', 'photos');
    }

    /**
     * Cadastrar novo animal
     * 
     * Cria um novo registro de animal no sistema. Requer autenticação.
     * 
     * @group Animais
     * @authenticated
     * 
     * @response 201 {
     *   "id": 1,
     *   "name": "Rex",
     *   "species": "dog",
     *   "breed": "Labrador",
     *   "age": 3,
     *   "size": "large",
     *   "status": "available",
     *   "organization_id": 1,
     *   "created_at": "2026-01-27T10:00:00.000000Z"
     * }
     * 
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
     * 
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "name": ["The name field is required."]
     *   }
     * }
     */
    public function store(AnimalStoreRequest $request)
    {
        $animal = Animal::create($request->validated());

        return response()->json($animal, 201);
    }

    /**
     * Atualizar animal
     * 
     * Atualiza as informações de um animal existente.
     * 
     * @group Animais
     * @authenticated
     * 
     * @urlParam animal integer required ID do animal. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "name": "Rex Atualizado",
     *   "species": "dog",
     *   "status": "adopted",
     *   "updated_at": "2026-01-27T11:00:00.000000Z"
     * }
     */
    public function update(AnimalUpdateRequest $request, Animal $animal)
    {
        $animal->update($request->validated());
        return $animal;
    }

    /**
     * Excluir animal
     * 
     * Remove um animal do sistema.
     * 
     * @group Animais
     * @authenticated
     * 
     * @urlParam animal integer required ID do animal. Example: 1
     * 
     * @response 204 {}
     * 
     * @response 403 {
     *   "message": "This action is unauthorized."
     * }
     */
    public function destroy(Animal $animal)
    {
        $animal->delete();
        return response()->noContent();
    }
}
