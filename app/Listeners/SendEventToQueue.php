<?php

namespace App\Listeners;

use App\Events\EventReceived;
use App\Jobs\CreateAccountEvent;
use Illuminate\Support\Facades\Process;

class SendEventToQueue
{
    public const string QUEUE_PREFIX = 'account_';

    /**
     * Handle the event.
     */
    public function handle(EventReceived $event): void
    {
        $accountEvent = $event->accountEvent;

        $maxQueueCount = config('common.queues.accounts_events.max_queue_count');

        $queueName = sprintf(
            "%s%s",
            self::QUEUE_PREFIX,
            $accountEvent->accountId % $maxQueueCount
        );

        CreateAccountEvent::dispatch($accountEvent)->onQueue($queueName);
    }
}
