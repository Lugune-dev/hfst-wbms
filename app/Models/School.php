<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'education_level',
        'region',
        'district',
        'ward',
        'address',
        'contact_person',
        'contact_phone',
        'contact_email',
        'student_capacity',
        'is_active',
        'notes',
    ];

    protected $casts = [
        'is_active'        => 'boolean',
        'student_capacity' => 'integer',
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function aidApplications(): HasMany
    {
        return $this->hasMany(AidApplication::class);
    }

    public function __toString(): string
    {
        return $this->name ?? '';
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'school_user')
            ->withPivot('role_in_school')
            ->withTimestamps();
    }

    public function getActiveStudentsCountAttribute(): int
    {
        return $this->students()->where('status', 'Active')->count();
    }
}
