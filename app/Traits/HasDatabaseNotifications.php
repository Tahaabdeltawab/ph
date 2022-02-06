<?php

namespace App\Traits;

use App\Models\Notification;

trait HasDatabaseNotifications
{
    /**
     * Get the entity's notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')->orderBy('created_at', 'desc');
    }

    /**
     * Get the entity's seen notifications.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function seenNotifications()
    {
        return $this->notifications()->seen();
    }

    /**
     * Get the entity's unseen notifications.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function unseenNotifications()
    {
        return $this->notifications()->unseen();
    }
    /**
     * Get the entity's read notifications.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function readNotifications()
    {
        return $this->notifications()->read();
    }

    /**
     * Get the entity's unread notifications.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function unreadNotifications()
    {
        return $this->notifications()->unread();
    }
}
