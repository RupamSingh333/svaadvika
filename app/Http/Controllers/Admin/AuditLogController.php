<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuditLog;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditLog::with('user')->latest();

        if ($request->has('user_id') && $request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('module') && $request->module) {
            $query->where('module', $request->module);
        }
        
        if ($request->has('action') && $request->action) {
            $query->where('action', $request->action);
        }

        $logs = $query->paginate(20)->withQueryString();
        
        $modules = AuditLog::select('module')->distinct()->pluck('module');
        $actions = AuditLog::select('action')->distinct()->pluck('action');

        return view('admin.audit_logs.index', compact('logs', 'modules', 'actions'));
    }

    public function show(AuditLog $auditLog)
    {
        $auditLog->load('user');
        return view('admin.audit_logs.show', compact('auditLog'));
    }
}
