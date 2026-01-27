<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContentStoreRequest;
use App\Http\Requests\ContentUpdateRequest;
use App\Models\Content;

class ContentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Content::class, 'content');
    }

    /**
     * Listar conteúdos
     * 
     * Retorna uma lista de conteúdos educativos e informativos.
     * 
     * @group Conteúdo
     * @unauthenticated
     * 
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "title": "Como cuidar de um cachorro",
     *       "body": "Dicas importantes...",
     *       "category": {},
     *       "author": {}
     *     }
     *   ]
     * }
     */
    public function index()
    {
        return Content::with('category', 'author')->paginate();
    }

    /**
     * Exibir conteúdo
     * 
     * Retorna detalhes de um conteúdo específico.
     * 
     * @group Conteúdo
     * @unauthenticated
     * 
     * @urlParam content integer required ID do conteúdo. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "title": "Como cuidar de um cachorro",
     *   "body": "Texto completo..."
     * }
     */
    public function show(Content $content)
    {
        return $content->load('category', 'author');
    }

    /**
     * Criar conteúdo
     * 
     * Cria um novo conteúdo informativo.
     * 
     * @group Conteúdo
     * @authenticated
     * 
     * @response 201 {
     *   "id": 1,
     *   "title": "Novo artigo",
     *   "author_id": 1
     * }
     */
    public function store(ContentStoreRequest $request)
    {
        return Content::create([
            ...$request->validated(),
            'author_id'  => auth()->id(),
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);
    }

    /**
     * Atualizar conteúdo
     * 
     * Atualiza informações de um conteúdo.
     * 
     * @group Conteúdo
     * @authenticated
     * 
     * @urlParam content integer required ID do conteúdo. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "title": "Artigo atualizado"
     * }
     */
    public function update(ContentUpdateRequest $request, Content $content)
    {
        $content->update($request->validated());
        $content->updated_by = auth()->id();
        $content->save();

        return $content;
    }

    /**
     * Excluir conteúdo
     * 
     * Remove um conteúdo do sistema.
     * 
     * @group Conteúdo
     * @authenticated
     * 
     * @urlParam content integer required ID do conteúdo. Example: 1
     * 
     * @response 204 {}
     */
    public function destroy(Content $content)
    {
        $content->delete();
        return response()->noContent();
    }
}
