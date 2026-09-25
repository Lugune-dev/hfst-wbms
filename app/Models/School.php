<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        'image',
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

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        if (Str::startsWith($this->image, ['http://', 'https://', '//'])) {
            return $this->image;
        }

        if (Str::startsWith($this->image, 'images/')) {
            return asset($this->image);
        }

        if (file_exists(public_path('images/' . $this->image))) {
            return asset('images/' . $this->image);
        }

        if (file_exists(public_path($this->image))) {
            return asset($this->image);
        }

        if (Storage::disk('public')->exists($this->image)) {
            return Storage::disk('public')->url($this->image);
        }

        return null;
    }
}
