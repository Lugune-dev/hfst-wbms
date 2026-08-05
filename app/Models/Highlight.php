<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getThumbAttribute()
    {
        // Prefer uploaded file
        if (! empty($this->attributes['image'])) {
            return \Illuminate\Support\Facades\Storage::disk('public')->url($this->attributes['image']);
        }

        // Fallback to external URL if provided
        if (! empty($this->attributes['image_url'])) {
            return $this->attributes['image_url'];
        }

        return null;
    }

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'image_url',
        'is_active',
        'sort_order',
    ];
}
