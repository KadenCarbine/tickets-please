<?php

namespace App\Policies\V1;

use App\Models\Ticket;
use App\Models\User;
use App\Permissions\V1\Abilities;

class TicketPolicy
{
    public function update(User $user, Ticket $ticket): bool
    {
        if ($user->tokenCan(Abilities::UpdateTicket)) {
            return true;
        } else {
            if ($user->tokenCan(Abilities::UpdateOwnTicket)) {
                return $user->id === $ticket->user_id;
            }
        }

        return false;
    }

    public function delete(User $user, Ticket $ticket): bool
    {
        if ($user->tokenCan(Abilities::DeleteTicket)) {
            return true;
        } else {
            if ($user->tokenCan(Abilities::DeleteOwnTicket)) {
                return $user->id === $ticket->user_id;
            }
        }
        return false;
    }

    public function replace(User $user, Ticket $ticket): bool
    {
        if ($user->tokenCan(Abilities::ReplaceTicket)) {
            return true;
        }
        return false;
    }

    public function store(User $user, Ticket $ticket): bool
    {
        if ($user->tokenCan(Abilities::CreateTicket)) {
            return true;
        }
        return false;
    }
}
