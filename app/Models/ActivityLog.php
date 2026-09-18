<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'role',
        'action',
        'description',
        'ip_address',
        'user_agent',
        'properties',
    ];

    protected $casts = [
        'properties' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Record an audit activity in the system
     */
    public static function record(
        string $action,
        string $description,
        ?User $user = null,
        array $properties = []
    ): self {
        $user = $user ?: auth()->user();
        $role = $user ? ($user->roles->first()?->name ?? 'user') : 'system';

        return self::create([
            'user_id'     => $user?->id,
            'user_name'   => $user?->name ?? 'System/Visitor',
            'user_email'  => $user?->email ?? null,
            'role'        => $role,
            'action'      => strtoupper($action),
            'description' => $description,
            'ip_address'  => request()?->ip() ?? '127.0.0.1',
            'user_agent'  => substr(request()?->userAgent() ?? 'System', 0, 500),
            'properties'  => $properties,
        ]);
    }
}
