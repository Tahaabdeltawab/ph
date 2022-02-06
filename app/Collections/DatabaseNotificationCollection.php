<?php

namespace App\Collections;

use Illuminate\Notifications\DatabaseNotificationCollection as NotificationsDatabaseNotificationCollection;

class DatabaseNotificationCollection extends NotificationsDatabaseNotificationCollection
{
    /**
     * Mark all notifications as seen.
     *
     * @return void
     */
    public function markAsSeen()
    {
        $this->each->markAsSeen();
    }

    /**
     * Mark all notifications as unseen.
     *
     * @return void
     */
    public function markAsUnseen()
    {
        $this->each->markAsUnseen();
    }
}
