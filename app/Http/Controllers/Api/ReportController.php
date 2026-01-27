<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportStoreRequest;
use App\Http\Requests\ReportUpdateRequest;
use App\Models\Report;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Report::class, 'report');
    }

    /**
     * Listar relatórios
     * 
     * Retorna uma lista de relatórios/denúncias.
     * 
     * @group Relatórios
     * @authenticated
     * 
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "type": "abuse",
     *       "description": "Animal em situação de risco",
     *       "status": "pending",
     *       "reporter": {},
     *       "assignedUser": null
     *     }
     *   ]
     * }
     */
    public function index()
    {
        return Report::with('reporter', 'assignedUser')->paginate();
    }

    /**
     * Exibir relatório
     * 
     * Retorna detalhes de um relatório específico.
     * 
     * @group Relatórios
     * @authenticated
     * 
     * @urlParam report integer required ID do relatório. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "type": "abuse",
     *   "description": "Detalhes...",
     *   "reporter": {},
     *   "attachments": []
     * }
     */
    public function show(Report $report)
    {
        return $report->load('reporter', 'assignedUser', 'attachments');
    }

    /**
     * Criar relatório
     * 
     * Cria um novo relatório ou denúncia.
     * 
     * @group Relatórios
     * @authenticated
     * 
     * @response 201 {
     *   "id": 1,
     *   "type": "abuse",
     *   "status": "pending",
     *   "reporter_id": 1
     * }
     */
    public function store(ReportStoreRequest $request)
    {
        $report = Report::create([
            ...$request->validated(),
            'reporter_id' => auth()->id(),
            'status'      => 'pending',
            'created_by'  => auth()->id(),
            'updated_by'  => auth()->id(),
        ]);

        return response()->json($report, 201);
    }

    /**
     * Atualizar relatório
     * 
     * Atualiza o status ou informações de um relatório.
     * 
     * @group Relatórios
     * @authenticated
     * 
     * @urlParam report integer required ID do relatório. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "status": "resolved"
     * }
     */
    public function update(ReportUpdateRequest $request, Report $report)
    {
        $report->update($request->validated());
        $report->updated_by = auth()->id();
        $report->save();

        return $report;
    }

    /**
     * Excluir relatório
     * 
     * Remove um relatório do sistema.
     * 
     * @group Relatórios
     * @authenticated
     * 
     * @urlParam report integer required ID do relatório. Example: 1
     * 
     * @response 204 {}
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return response()->noContent();
    }
}
