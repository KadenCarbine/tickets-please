<?php

use App\Http\Controllers\Api\V1\AuthorsController;
use App\Http\Controllers\Api\V1\AuthorsTicketController;
use App\Http\Controllers\Api\V1\TicketController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('tickets', TicketController::class)->except(['update']);
    Route::put('tickets/{ticket}', [TicketController::class, 'replace'])->name('tickets.replace');
    Route::patch('tickets/{ticket}', [TicketController::class, 'update']);

    Route::apiResource('authors', AuthorsController::class);
    Route::apiResource('authors.tickets', AuthorsTicketController::class)->except(['update']);
    Route::put('authors/{author}/tickets/{ticket}', [AuthorsTicketController::class, 'replace']);
    Route::patch('authors/{author}/tickets/{ticket}', [AuthorsTicketController::class, 'update']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
