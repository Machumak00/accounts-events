<?php

namespace App\Jobs;

use App\DTO\AccountEvent as AccountEventDTO;
use App\Models\AccountEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateAccountEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public readonly AccountEventDTO $accountEvent)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        sleep(1);

        AccountEvent::query()->create($this->accountEvent->toArray());
    }
}
