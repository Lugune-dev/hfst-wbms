<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'role',
        'message',
        'photo',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->photo) {
            return null;
        }

        if (Str::startsWith($this->photo, ['http://', 'https://', 'images/'])) {
            return asset($this->photo);
        }

        return Storage::url($this->photo);
    }
}
