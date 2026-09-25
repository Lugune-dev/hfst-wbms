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

        if (Str::startsWith($this->photo, ['http://', 'https://', '//'])) {
            return $this->photo;
        }

        if (Str::startsWith($this->photo, 'images/')) {
            return asset($this->photo);
        }

        if (file_exists(public_path('images/' . $this->photo))) {
            return asset('images/' . $this->photo);
        }

        if (file_exists(public_path($this->photo))) {
            return asset($this->photo);
        }

        if (Storage::disk('public')->exists($this->photo)) {
            return Storage::disk('public')->url($this->photo);
        }

        return null;
    }
}
