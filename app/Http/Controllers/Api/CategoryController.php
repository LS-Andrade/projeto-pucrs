<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }

    /**
     * Listar categorias
     * 
     * Retorna uma lista de categorias de animais.
     * 
     * @group Categorias
     * @unauthenticated
     * 
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "Cachorro",
     *       "description": "Cães de todos os portes"
     *     }
     *   ]
     * }
     */
    public function index()
    {
        return Category::paginate();
    }

    /**
     * Exibir categoria
     * 
     * Retorna detalhes de uma categoria específica.
     * 
     * @group Categorias
     * @unauthenticated
     * 
     * @urlParam category integer required ID da categoria. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "name": "Cachorro"
     * }
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Cadastrar categoria
     * 
     * Cria uma nova categoria de animais.
     * 
     * @group Categorias
     * @authenticated
     * 
     * @response 201 {
     *   "id": 1,
     *   "name": "Cachorro"
     * }
     */
    public function store(CategoryStoreRequest $request)
    {
        return Category::create($request->validated());
    }

    /**
     * Atualizar categoria
     * 
     * Atualiza informações de uma categoria.
     * 
     * @group Categorias
     * @authenticated
     * 
     * @urlParam category integer required ID da categoria. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "name": "Cachorro Atualizado"
     * }
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->validated());
        return $category;
    }

    /**
     * Excluir categoria
     * 
     * Remove uma categoria do sistema.
     * 
     * @group Categorias
     * @authenticated
     * 
     * @urlParam category integer required ID da categoria. Example: 1
     * 
     * @response 204 {}
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->noContent();
    }
}
