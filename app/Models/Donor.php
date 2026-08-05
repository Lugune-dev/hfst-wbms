<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Donor extends Model
{
    protected $fillable = [
        'user_id',
        'organization_name',
        'phone',
        'address',
        'country',
        'donor_type',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function getTotalDonatedAttribute(): float
    {
        return $this->donations()->where('status', 'Confirmed')->sum('amount');
    }
}
