<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'budget',
        'current_funding',
        'thumb',
        'thumb_url',
        'start_date',
        'end_date',
        'status',
        'created_by',
    ];

    public function getThumbUrlAttribute(): ?string
    {
        // If stored file path exists, return public disk url
        if (!empty($this->attributes['thumb'])) {
            $path = $this->attributes['thumb'];
            // If the stored value is already a full URL, return it directly
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
                return $path;
            }

            return \Illuminate\Support\Facades\Storage::disk('public')->url($path);
        }

        // If an external URL was provided in thumb_url, return it
        if (!empty($this->attributes['thumb_url'])) {
            return $this->attributes['thumb_url'];
        }

        return null;
    }

    protected $casts = [
        'start_date'      => 'date',
        'end_date'        => 'date',
        'budget'          => 'decimal:2',
        'current_funding' => 'decimal:2',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'project_student')
            ->withPivot(['assigned_date', 'status'])
            ->withTimestamps();
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function getFundingPercentageAttribute(): float
    {
        if ($this->budget == 0) return 0;
        return round(($this->current_funding / $this->budget) * 100, 2);
    }
}
