<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('users')->group(base_path('routes/api/usersRoutes.php'));
Route::middleware('auth:sanctum')->prefix('holiday-plans')->group(base_path('routes/api/holidayPlansRoutes.php'));
Route::prefix('auth')->group(base_path('routes/api/authRoutes.php'));

Route::get('/', function (){
   return response()->json([
       "message"=>"connection was successful"
   ]);
});

