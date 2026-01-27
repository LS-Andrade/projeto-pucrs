<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationStoreRequest;
use App\Http\Requests\OrganizationUpdateRequest;
use App\Models\Organization;

class OrganizationController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Organization::class, 'organization');
    }

    /**
     * Listar todas as organizações
     * 
     * Retorna uma lista paginada de organizações protetoras de animais.
     * 
     * @group Organizações
     * @unauthenticated
     * 
     * @queryParam page integer Número da página. Example: 1
     * 
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "ONG Amigos dos Animais",
     *       "email": "contato@ongamigos.org",
     *       "phone": "(51) 99999-9999",
     *       "address": "Rua das Flores, 123",
     *       "users": []
     *     }
     *   ]
     * }
     */
    public function index()
    {
        return Organization::with('users')->orderBy('created_at', 'desc')->paginate(10);
    }

    /**
     * Exibir detalhes da organização
     * 
     * Retorna informações detalhadas de uma organização específica.
     * 
     * @group Organizações
     * @unauthenticated
     * 
     * @urlParam organization integer required ID da organização. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "name": "ONG Amigos dos Animais",
     *   "email": "contato@ongamigos.org",
     *   "users": []
     * }
     */
    public function show(Organization $organization)
    {
        return $organization->load('users');
    }

    /**
     * Cadastrar nova organização
     * 
     * Cria uma nova organização protetora no sistema.
     * 
     * @group Organizações
     * @authenticated
     * 
     * @response 201 {
     *   "id": 1,
     *   "name": "ONG Amigos dos Animais",
     *   "email": "contato@ongamigos.org",
     *   "created_at": "2026-01-27T10:00:00.000000Z"
     * }
     */
    public function store(OrganizationStoreRequest $request)
    {
        return Organization::create($request->validated() + [
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);
    }

    /**
     * Atualizar organização
     * 
     * Atualiza as informações de uma organização existente.
     * 
     * @group Organizações
     * @authenticated
     * 
     * @urlParam organization integer required ID da organização. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "name": "ONG Amigos dos Animais - Atualizado",
     *   "updated_at": "2026-01-27T11:00:00.000000Z"
     * }
     */
    public function update(OrganizationUpdateRequest $request, Organization $organization)
    {
        $organization->update($request->validated() + [
            'updated_by' => auth()->id(),
        ]);
        return $organization;
    }

    /**
     * Excluir organização
     * 
     * Remove uma organização do sistema.
     * 
     * @group Organizações
     * @authenticated
     * 
     * @urlParam organization integer required ID da organização. Example: 1
     * 
     * @response 204 {}
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();
        return response()->noContent();
    }
}
