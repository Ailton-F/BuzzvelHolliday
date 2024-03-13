<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'list']);
Route::withoutMiddleware('auth:sanctum')->post('/', [UserController::class, 'add']);
Route::post('/participate/{id_event}', [UserController::class, 'participate']);
Route::get('/{id}', [UserController::class, 'listById']);
Route::put('/{id}', [UserController::class, 'edit']);
Route::delete('/{id}', [UserController::class, 'destroy']);
