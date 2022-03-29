<?php

namespace App\Models;

use App\Collections\DatabaseNotificationCollection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
        'seen_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::addGlobalScope('latest', function ($builder) {
            $builder->latest();
        });
    }

    public function markAsSeen()
    {
        if (is_null($this->seen_at)) {
            $this->forceFill(['seen_at' => $this->freshTimestamp()])->save();
        }
    }

    public function markAsUnseen()
    {
        if (! is_null($this->seen_at)) {
            $this->forceFill(['seen_at' => null])->save();
        }
    }

    public function seen()
    {
        return $this->seen_at !== null;
    }

    public function unseen()
    {
        return $this->seen_at === null;
    }

    public function scopeSeen(Builder $query)
    {
        return $query->whereNotNull('seen_at');
    }

    public function scopeUnseen(Builder $query)
    {
        return $query->whereNull('seen_at');
    }

    
    /**
     * Create a new database notification collection instance.
     *
     * @param  array  $models
     * @return \App\Collections\DatabaseNotificationCollection
     */
    public function newCollection(array $models = [])
    {
        return new DatabaseNotificationCollection($models);
    }
}
