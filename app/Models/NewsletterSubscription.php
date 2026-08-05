<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscription extends Model
{
    protected $fillable = [
        'email',
        'name',
        'confirmed',
        'token',
    ];

    protected $casts = [
        'confirmed' => 'boolean',
    ];
}
