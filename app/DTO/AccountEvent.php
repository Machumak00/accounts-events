<?php

namespace App\DTO;

readonly class AccountEvent
{
    public function __construct(
        public int $accountId,
        public int $eventId,
    ) {
    }

    public function toArray(): array
    {
        return [
            'account_id' => $this->accountId,
            'event_id' => $this->eventId,
        ];
    }
}
