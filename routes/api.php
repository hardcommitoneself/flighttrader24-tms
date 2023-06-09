<?php

use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['as' => 'api.'], function() {
    Route::post('/v1/tickets', [TicketController::class, 'create']);
    Route::delete('/v1/tickets/{id}', [TicketController::class, 'cancel']);
    Route::patch('/v1/tickets/{id}/change-seat', [TicketController::class, 'changeSeat']);
});
