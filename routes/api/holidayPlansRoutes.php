<?php

use App\Http\Controllers\HolidayPlansController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HolidayPlansController::class, 'list']);
Route::get('/get-pdf/{id}', [HolidayPlansController::class, 'getPdf']);
Route::get('/{id}', [HolidayPlansController::class, 'listById']);
Route::post('/', [HolidayPlansController::class, 'add']);
Route::put('/{id}', [HolidayPlansController::class, 'edit']);
Route::delete('/{id}', [HolidayPlansController::class, 'destroy']);
