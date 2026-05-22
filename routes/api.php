<?php

use App\Http\Controllers\API\CycleController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\SensorController;
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
Route::post('/readings', [SensorController::class, 'storeSensorData']);
Route::post('/store-daily-readings', [SensorController::class, 'storeDailySensorData']);
Route::post('/notifications', [NotificationController::class, 'store']);
Route::get('/cycles', [CycleController::class, 'index']);
Route::put('/cycles/{id}/update-phase', [CycleController::class, 'updatePhase']);
Route::get('/cycles/latest', [CycleController::class, 'latest']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
