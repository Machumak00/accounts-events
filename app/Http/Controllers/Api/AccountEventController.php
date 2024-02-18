<?php

namespace App\Http\Controllers\Api;

use App\DTO\AccountEvent as AccountEventDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReceiveEventRequest;
use App\Services\AccountEvent as AccountEventService;
use Illuminate\Http\JsonResponse;

class AccountEventController extends Controller
{
    public function receiveEvent(ReceiveEventRequest $request, AccountEventService $accountEventService): JsonResponse
    {
        $accountEventService->receiveEvent(
            new AccountEventDTO(
                $request->integer('account_id'),
                $request->integer('event_id'),
            )
        );

        return response()->json(['message' => __('messages.event_sent_to_queue')]);
    }
}
