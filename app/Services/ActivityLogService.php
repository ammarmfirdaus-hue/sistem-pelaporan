<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\User;

class ActivityLogService
{
    public function record(string $action, string $module, ?string $description = null, array $metadata = [], ?User $user = null): void
    {
        ActivityLog::create([
            'user_id' => $user?->id ?? auth()->id(),
            'action' => $action,
            'module' => $module,
            'description' => $description,
            'ip_address' => request()?->ip(),
            'user_agent' => substr((string) request()?->userAgent(), 0, 1000),
            'metadata' => $metadata ?: null,
        ]);
    }
}
