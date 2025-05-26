<?php

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\V1\TicketController;
use App\Http\Controllers\Api\V1\AuthorsController;
use App\Http\Controllers\Api\V1\AuthorsTicketController;

Route::apiResource('tickets', TicketController::class)->middleware('auth:sanctum');
Route::apiResource('authors', AuthorsController::class)->middleware('auth:sanctum');
Route::apiResource('authors.tickets', AuthorsTicketController::class)->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');