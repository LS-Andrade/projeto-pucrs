<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportAttachmentStoreRequest;
use App\Http\Requests\ReportAttachmentUpdateRequest;
use App\Models\ReportAttachment;
use Illuminate\Support\Facades\Storage;

class ReportAttachmentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ReportAttachment::class, 'report_attachment');
    }

    /**
     * Listar anexos de relatórios
     * 
     * Retorna uma lista de anexos de relatórios.
     * 
     * @group Relatórios
     * @authenticated
     * 
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "report_id": 1,
     *       "file_path": "reports/file.jpg",
     *       "report": {}
     *     }
     *   ]
     * }
     */
    public function index()
    {
        return ReportAttachment::with('report')->paginate();
    }

    /**
     * Exibir anexo
     * 
     * Retorna detalhes de um anexo específico.
     * 
     * @group Relatórios
     * @authenticated
     * 
     * @urlParam report_attachment integer required ID do anexo. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "file_path": "reports/file.jpg",
     *   "report": {}
     * }
     */
    public function show(ReportAttachment $report_attachment)
    {
        return $report_attachment->load('report');
    }

    /**
     * Upload de anexo
     * 
     * Faz upload de um arquivo anexo ao relatório.
     * 
     * @group Relatórios
     * @authenticated
     * 
     * @bodyParam report_id integer required ID do relatório. Example: 1
     * @bodyParam file file required Arquivo a ser anexado.
     * 
     * @response 201 {
     *   "id": 1,
     *   "report_id": 1,
     *   "file_path": "reports/abc123.jpg"
     * }
     */
    public function store(ReportAttachmentStoreRequest $request)
    {
        $path = $request->file('file')->store('reports', 'public');

        $attachment = ReportAttachment::create([
            'report_id' => $request->validated()['report_id'],
            'file_path' => $path,
            'created_by'=> auth()->id(),
            'updated_by'=> auth()->id(),
        ]);

        return response()->json($attachment, 201);
    }

    /**
     * Atualizar anexo
     * 
     * Substitui o arquivo de um anexo.
     * 
     * @group Relatórios
     * @authenticated
     * 
     * @urlParam report_attachment integer required ID do anexo. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "file_path": "reports/novo_arquivo.jpg"
     * }
     */
    public function update(ReportAttachmentUpdateRequest $request, ReportAttachment $report_attachment)
    {
        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($report_attachment->file_path);
            $report_attachment->file_path = $request->file('file')->store('reports', 'public');
        }

        $report_attachment->updated_by = auth()->id();
        $report_attachment->save();

        return $report_attachment;
    }

    /**
     * Excluir anexo
     * 
     * Remove um anexo do relatório.
     * 
     * @group Relatórios
     * @authenticated
     * 
     * @urlParam report_attachment integer required ID do anexo. Example: 1
     * 
     * @response 204 {}
     */
    public function destroy(ReportAttachment $report_attachment)
    {
        Storage::disk('public')->delete($report_attachment->file_path);
        $report_attachment->delete();

        return response()->noContent();
    }
}
