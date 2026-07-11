<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Str;

trait Auditable
{
    public static function bootAuditable()
    {
        static::created(function ($model) {
            $model->logAudit('create', null, $model->getAttributes());
        });

        static::updated(function ($model) {
            $old = [];
            $new = [];

            foreach ($model->getDirty() as $key => $value) {
                $old[$key] = $model->getOriginal($key);
                $new[$key] = $value;
            }

            $model->logAudit('update', $old, $new);
        });

        static::deleted(function ($model) {
            $model->logAudit('delete', $model->getAttributes(), null);
        });
        
        if (method_exists(static::class, 'restored')) {
            static::restored(function ($model) {
                $model->logAudit('restore', null, $model->getAttributes());
            });
        }
    }

    protected function logAudit($action, $oldData = null, $newData = null)
    {
        // Don't log if running in console (e.g. migrations/seeders) unless you want to
        if (app()->runningInConsole()) return;

        // Try to get module name from class name
        $module = Str::kebab(class_basename($this));

        AuditLog::create([
            'user_id' => auth()->id(),
            'module' => $module,
            'action' => $action,
            'record_id' => $this->id,
            'old_data' => $oldData,
            'new_data' => $newData,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'session_id' => request()->session()->getId(),
        ]);
    }
}
