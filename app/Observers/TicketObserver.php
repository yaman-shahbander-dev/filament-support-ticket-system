<?php

namespace App\Observers;

use App\Models\Ticket;
use Filament\Notifications\Notification;

class TicketObserver
{
    /**
     * Handle the Ticket "created" event.
     */
    public function created(Ticket $ticket): void
    {
        $user = $ticket->assignedTo;

        logger(Notification::make()
            ->title('A ticket has been assigned to you!')
            ->sendToDatabase($user));
    }

    /**
     * Handle the Ticket "updated" event.
     */
    public function updated(Ticket $ticket): void
    {
        //
    }
}
