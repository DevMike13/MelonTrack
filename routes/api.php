<?php

use App\Http\Controllers\API\CycleController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\SensorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Sensor APIs
|--------------------------------------------------------------------------
*/

// Route::post('/readings', [SensorController::class, 'storeSensorData']);
Route::post('/daily-sensor-data', [SensorController::class, 'storeDailySensorData']);

/*
|--------------------------------------------------------------------------
| Notification APIs
|--------------------------------------------------------------------------
*/

Route::post('/notifications', [NotificationController::class, 'store']);

/*
|--------------------------------------------------------------------------
| Cycle APIs
|--------------------------------------------------------------------------
*/

Route::get('/cycles', [CycleController::class, 'index']);
Route::get('/cycles/latest', [CycleController::class, 'latest']);
Route::put('/cycles/{id}/update-phase', [CycleController::class, 'updatePhase']);

/*
|--------------------------------------------------------------------------
| Authenticated User
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
