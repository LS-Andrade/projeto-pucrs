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

    /**
     * Listar todas as adoções
     * 
     * Retorna uma lista paginada de processos de adoção.
     * 
     * @group Adoções
     * @authenticated
     * 
     * @queryParam page integer Número da página. Example: 1
     * 
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "status": "pending",
     *       "animal": {
     *         "id": 1,
     *         "name": "Rex"
     *       },
     *       "adopter": {
     *         "id": 2,
     *         "name": "João Silva"
     *       },
     *       "created_at": "2026-01-27T10:00:00.000000Z"
     *     }
     *   ]
     * }
     */
    public function index()
    {
        return Adoption::with('animal', 'adopter')->orderBy('created_at', 'desc')->paginate(10);
    }

    /**
     * Minhas adoções
     * 
     * Retorna as adoções do usuário autenticado como adotante.
     * 
     * @group Adoções
     * @authenticated
     * 
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "status": "approved",
     *       "animal": {
     *         "id": 1,
     *         "name": "Rex",
     *         "organization": {
     *           "name": "ONG Amigos"
     *         }
     *       }
     *     }
     *   ]
     * }
     */
    public function myAdoptions()
    {
        return Adoption::where('adopter_id', auth()->id())
            ->with('animal', 'animal.organization')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    /**
     * Exibir detalhes da adoção
     * 
     * Retorna informações detalhadas de um processo de adoção.
     * 
     * @group Adoções
     * @authenticated
     * 
     * @urlParam adoption integer required ID da adoção. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "status": "pending",
     *   "motivation": "Quero dar um lar amoroso",
     *   "animal": {},
     *   "adopter": {},
     *   "followups": []
     * }
     */
    public function show(Adoption $adoption)
    {
        return $adoption->load('animal', 'adopter', 'followups');
    }

    /**
     * Solicitar adoção
     * 
     * Cria uma nova solicitação de adoção.
     * 
     * @group Adoções
     * @authenticated
     * 
     * @response 201 {
     *   "id": 1,
     *   "animal_id": 1,
     *   "adopter_id": 2,
     *   "status": "pending",
     *   "motivation": "Quero dar um lar amoroso",
     *   "created_at": "2026-01-27T10:00:00.000000Z"
     * }
     */
    public function store(AdoptionStoreRequest $request)
    {
        $adoption = Adoption::create([
            'animal_id' => $request->validated()['animal_id'],
            'adopter_id'=> auth()->id(),
            'motivation'=> $request->validated()['motivation'] ?? null,
            'status'    => 'pending',
            'created_by'=> auth()->id(),
            'updated_by'=> auth()->id(),
        ]);

        return response()->json($adoption, 201);
    }

    /**
     * Atualizar adoção
     * 
     * Atualiza o status ou informações de uma adoção.
     * 
     * @group Adoções
     * @authenticated
     * 
     * @urlParam adoption integer required ID da adoção. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "status": "approved",
     *   "updated_at": "2026-01-27T11:00:00.000000Z"
     * }
     */
    public function update(AdoptionUpdateRequest $request, Adoption $adoption)
    {
        $adoption->update($request->validated());
        $adoption->updated_by = auth()->id();
        $adoption->save();

        return $adoption;
    }

    /**
     * Cancelar adoção
     * 
     * Cancela um processo de adoção.
     * 
     * @group Adoções
     * @authenticated
     * 
     * @urlParam adoption integer required ID da adoção. Example: 1
     * 
     * @response 204 {}
     */
    public function destroy(Adoption $adoption)
    {
        $adoption->delete();
        return response()->noContent();
    }
}
