<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiveEventRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'account_id' => ['required', 'int'],
            'event_id' => ['required', 'int']
        ];
    }
}
