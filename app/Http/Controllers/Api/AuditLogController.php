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

    public function index()
    {
        return AuditLog::with('user')->paginate();
    }

    public function show(AuditLog $audit_log)
    {
        return $audit_log->load('user');
    }
}
