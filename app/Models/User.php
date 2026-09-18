<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasTenants
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_active'         => 'boolean',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if (!$this->is_active) {
            return false;
        }

        return match ($panel->getId()) {
            'admin'   => $this->hasRole(['admin']),
            'staff'   => $this->hasRole('staff'),
            'teacher' => $this->hasRole('teacher'),
            'donor'   => $this->hasRole('donor'),
            'student' => $this->hasRole('student'),
            default   => false,
        };
    }

    public function schools(): BelongsToMany
    {
        return $this->belongsToMany(School::class, 'school_user')
            ->withPivot('role_in_school')
            ->withTimestamps();
    }

    public function getTenants(Panel $panel): array|Collection
    {
        if ($this->hasRole('admin')) {
            return School::where('is_active', true)->get();
        }

        return $this->schools()->where('is_active', true)->get();
    }

    public function canAccessTenant(Model $tenant): bool
    {
        if ($this->hasRole('admin')) {
            return true;
        }

        return $this->schools->contains($tenant);
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    public function donor(): HasOne
    {
        return $this->hasOne(Donor::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }
}
