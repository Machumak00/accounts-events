<?php

namespace App\Services;

use App\DTO\AccountEvent as AccountEventDTO;
use App\Events\EventReceived;

class AccountEvent
{
    public function receiveEvent(AccountEventDTO $accountEvent): void
    {
        event(new EventReceived($accountEvent));
    }
}
