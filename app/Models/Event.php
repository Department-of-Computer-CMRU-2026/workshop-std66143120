<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = [
        'title',
        'speaker',
        'location',
        'total_seats',
    ];

    /**
     * Get the registrations for this event.
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Get the users registered for this event.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class , 'registrations')->withTimestamps();
    }

    /**
     * Accessor: Calculate remaining seats.
     */
    public function getRemainingSeatsAttribute(): int
    {
        return $this->total_seats - $this->registrations()->count();
    }
}
