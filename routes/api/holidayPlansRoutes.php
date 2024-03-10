<?php

use App\Http\Controllers\HolidayPlansController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HolidayPlansController::class, 'list']);
Route::post('/', [HolidayPlansController::class, 'add']);
Route::get('/{id}', [HolidayPlansController::class, 'listById']);
Route::put('/{id}', [HolidayPlansController::class, 'edit']);
Route::delete('/{id}', [HolidayPlansController::class, 'destroy']);
