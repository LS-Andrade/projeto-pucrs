<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;

class AuditLogController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(AuditLog::class, 'audit_log');
    }

    /**
     * Listar logs de auditoria
     * 
     * Retorna uma lista de logs de auditoria do sistema.
     * 
     * @group Logs de Auditoria
     * @authenticated
     * 
     * @queryParam page integer Número da página. Example: 1
     * 
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "action": "create",
     *       "model": "Animal",
     *       "model_id": 5,
     *       "user": {
     *         "id": 1,
     *         "name": "Jo\u00e3o Silva"
     *       },
     *       "created_at": "2026-01-27T10:00:00.000000Z"
     *     }
     *   ]
     * }
     */
    public function index()
    {
        return AuditLog::with('user')->paginate();
    }

    /**
     * Exibir log de auditoria
     * 
     * Retorna detalhes de um log espec\u00edfico.
     * 
     * @group Logs de Auditoria
     * @authenticated
     * 
     * @urlParam audit_log integer required ID do log. Example: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "action": "update",
     *   "model": "Animal",
     *   "old_values": {},
     *   "new_values": {},
     *   "user": {}
     * }
     */
    public function show(AuditLog $audit_log)
    {
        return $audit_log->load('user');
    }
}
