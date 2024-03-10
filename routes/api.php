<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(base_path('routes/api/usersRoutes.php'));
Route::prefix('holiday_plans')->group(base_path('routes/api/holidayPlansRoutes.php'));

