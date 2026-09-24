<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'gender',
        'age',
        'school_id',
        'school',
        'education_level',
        'requirements',
        'status',
        'documents',
        'progress_notes',
    ];

    protected $casts = [
        'requirements' => 'array',
        'documents'    => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function schoolRelation(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function getSchoolAttribute($value)
    {
        if ($this->school_id) {
            $school = $this->relationLoaded('school')
                ? $this->getRelation('school')
                : $this->school()->first();

            if ($school) {
                return $school;
            }
        }

        return $value ?: 'Arusha Secondary School';
    }

    public function getSchoolNameAttribute(): string
    {
        if ($this->school_id && $this->relationLoaded('school')) {
            return $this->getRelation('school')?->name ?? ($this->attributes['school'] ?? 'Arusha Secondary School');
        }

        if ($this->school_id && $sch = School::find($this->school_id)) {
            return $sch->name;
        }

        return is_string($this->attributes['school'] ?? null) && !empty($this->attributes['school'])
            ? $this->attributes['school']
            : 'Arusha Secondary School';
    }

    public function aidApplications(): HasMany
    {
        return $this->hasMany(AidApplication::class);
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_student')
            ->withPivot(['assigned_date', 'status'])
            ->withTimestamps();
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
