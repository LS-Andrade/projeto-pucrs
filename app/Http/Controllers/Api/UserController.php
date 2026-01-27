<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Listar todos os usuários
     * 
     * Retorna uma lista paginada de usuários do sistema.
     * 
     * @group Usuários
     * @authenticated
     * 
     * @queryParam page integer Número da página. Example: 1
     * 
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "João Silva",
     *       "email": "joao@example.com",
     *       "role": "adopter",
     *       "created_at": "2026-01-27T10:00:00.000000Z"
     *     }
     *   ]
     * }
     */
    public function index()
    {
        return User::orderBy('created_at', 'desc')->paginate(10);
    }

    /**
     * Exibir detalhes do usuário
     * 
     * Retorna informações detalhadas de um usuário específico.
     * 
     * @group Usuários
     * @authenticated
     * 
     * @urlParam user integer required ID do usuário. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "name": "João Silva",
     *   "email": "joao@example.com",
     *   "role": "adopter"
     * }
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Cadastrar novo usuário
     * 
     * Cria um novo usuário no sistema.
     * 
     * @group Usuários
     * @authenticated
     * 
     * @response 201 {
     *   "id": 1,
     *   "name": "João Silva",
     *   "email": "joao@example.com",
     *   "role": "adopter",
     *   "created_at": "2026-01-27T10:00:00.000000Z"
     * }
     */
    public function store(UserStoreRequest $request)
    {
        return User::create($request->validated() + [
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);
    }

    /**
     * Atualizar usuário
     * 
     * Atualiza as informações de um usuário existente.
     * 
     * @group Usuários
     * @authenticated
     * 
     * @urlParam user integer required ID do usuário. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "name": "João Silva Atualizado",
     *   "updated_at": "2026-01-27T11:00:00.000000Z"
     * }
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated() + [
            'updated_by' => auth()->id(),
        ]);
        return $user;
    }

    /**
     * Excluir usuário
     * 
     * Remove um usuário do sistema.
     * 
     * @group Usuários
     * @authenticated
     * 
     * @urlParam user integer required ID do usuário. Example: 1
     * 
     * @response 204 {}
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->noContent();
    }
}
