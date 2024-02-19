<?php

namespace Tests\Feature;

use App\DTO\AccountEvent;
use App\Jobs\CreateAccountEvent;
use App\Listeners\SendEventToQueue;
use Illuminate\Support\Facades\Queue;
use Random\RandomException;
use Tests\TestCase;

class AccountEventTest extends TestCase
{
    private AccountEvent $accountEvent;
    private string $queueName;

    /**
     * @throws RandomException
     */
    public function setUp(): void
    {
        parent::setUp();

        Queue::fake();

        $this->accountEvent = new AccountEvent(
            accountId: random_int(1, 1000),
            eventId: random_int(1, 1000),
        );

        $maxQueueCount = config('common.queues.accounts_events.max_queue_count');

        $this->queueName = sprintf(
            "%s%s",
            SendEventToQueue::QUEUE_PREFIX,
            $this->accountEvent->accountId % $maxQueueCount
        );
    }

    public function testCreate(): void
    {
        $response = $this->post(
            route('account-event.event-receive'),
            $this->accountEvent->toArray(),
            ['Accept' => 'application/json']
        );

        Queue::assertPushedOn(
            $this->queueName,
            CreateAccountEvent::class,
            fn(CreateAccountEvent $createAccountEvent) =>
                $createAccountEvent->accountEvent->toArray() === $this->accountEvent->toArray()
        );

        Queue::assertCount(1);

        $response->assertStatus(200);
        $response->assertJson(['message' => __('messages.event_sent_to_queue')]);
    }

    public function testCreateFailValidation(): void
    {
        Queue::assertNothingPushed();

        $response = $this->post(
            route('account-event.event-receive'),
            [
                'account_id' => 'string',
                'event_id' => 'string',
            ],
            ['Accept' => 'application/json']
        );

        $response->assertStatus(422);
    }
}
