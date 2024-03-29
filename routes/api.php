<?php

use App\Http\Controllers\Api\AccountEventController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('receive-event', [AccountEventController::class, 'receiveEvent'])
    ->name('account-event.event-receive');
