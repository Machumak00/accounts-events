<?php

namespace App\Listeners;

use App\Events\EventReceived;
use App\Jobs\CreateAccountEvent;
use Illuminate\Support\Facades\Process;

class SendEventToQueue
{
    public const string QUEUE_PREFIX = 'account_';
    public const int MAX_QUEUES_COUNT = 10;

    /**
     * Handle the event.
     */
    public function handle(EventReceived $event): void
    {
        $accountEvent = $event->accountEvent;

        $queueName = sprintf(
            "%s%s",
            self::QUEUE_PREFIX,
            $accountEvent->accountId % self::MAX_QUEUES_COUNT
        );

        CreateAccountEvent::dispatch($accountEvent)->onQueue($queueName);
    }
}
