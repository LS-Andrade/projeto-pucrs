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

    /**
     * Listar acompanhamentos de adoção
     * 
     * Retorna uma lista de acompanhamentos pós-adoção.
     * 
     * @group Adoções
     * @authenticated
     * 
     * @queryParam adoption_id integer Filtrar por ID da adoção. Example: 1
     * 
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "adoption_id": 1,
     *       "visit_date": "2026-02-15",
     *       "notes": "Animal adaptado bem",
     *       "adoption": {}
     *     }
     *   ]
     * }
     */
    public function index()
    {
        $query = AdoptionFollowup::with('adoption');

        if (request('adoption_id')) {
            $query->where('adoption_id', request('adoption_id'));
        }

        return $query->paginate();
    }

    /**
     * Exibir acompanhamento
     * 
     * Retorna detalhes de um acompanhamento específico.
     * 
     * @group Adoções
     * @authenticated
     * 
     * @urlParam adoption_followup integer required ID do acompanhamento. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "notes": "Animal bem adaptado",
     *   "adoption": {}
     * }
     */
    public function show(AdoptionFollowup $adoption_followup)
    {
        return $adoption_followup->load('adoption');
    }

    /**
     * Registrar acompanhamento
     * 
     * Cria um novo registro de acompanhamento pós-adoção.
     * 
     * @group Adoções
     * @authenticated
     * 
     * @response 201 {
     *   "id": 1,
     *   "adoption_id": 1,
     *   "visit_date": "2026-02-15",
     *   "notes": "Primeira visita realizada"
     * }
     */
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

    /**
     * Atualizar acompanhamento
     * 
     * Atualiza informações de um acompanhamento.
     * 
     * @group Adoções
     * @authenticated
     * 
     * @urlParam adoption_followup integer required ID do acompanhamento. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "notes": "Notas atualizadas"
     * }
     */
    public function update(AdoptionFollowupUpdateRequest $request, AdoptionFollowup $adoption_followup)
    {
        $adoption_followup->update($request->validated());
        $adoption_followup->updated_by = auth()->id();
        $adoption_followup->save();

        return $adoption_followup;
    }

    /**
     * Excluir acompanhamento
     * 
     * Remove um registro de acompanhamento.
     * 
     * @group Adoções
     * @authenticated
     * 
     * @urlParam adoption_followup integer required ID do acompanhamento. Example: 1
     * 
     * @response 204 {}
     */
    public function destroy(AdoptionFollowup $adoption_followup)
    {
        $adoption_followup->delete();
        return response()->noContent();
    }
}
