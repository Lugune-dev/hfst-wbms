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
            $path = $this->attributes['image'];
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
                return $path;
            }
            if (str_starts_with($path, 'images/')) {
                return asset($path);
            }
            if (file_exists(public_path('images/' . $path))) {
                return asset('images/' . $path);
            }
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
                return \Illuminate\Support\Facades\Storage::disk('public')->url($path);
            }
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
