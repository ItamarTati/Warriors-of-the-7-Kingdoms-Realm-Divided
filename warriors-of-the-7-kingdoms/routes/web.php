<?php

use App\Http\Controllers\KingdomController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ArmyController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\WarController;
use App\Http\Controllers\HealthController;
use Illuminate\Support\Facades\Route;

// Health check
Route::get('/ping', [HealthController::class, 'ping']);

// Kingdom routes
Route::prefix('kingdoms')->group(function () {
    Route::get('/', [KingdomController::class, 'index']);
    Route::get('/{kingdom}', [KingdomController::class, 'show']);
    Route::post('/', [KingdomController::class, 'store']);
    Route::put('/{kingdom}', [KingdomController::class, 'update']);
    Route::delete('/{kingdom}', [KingdomController::class, 'destroy']);
    
    // Kingdom actions
    Route::post('/{kingdom}/armies', [ArmyController::class, 'store']);
    Route::post('/{kingdom}/taxes', [TaxController::class, 'adjust']);
    Route::post('/{kingdom}/declare-war/{targetKingdom}', [WarController::class, 'declare']);
});

// Map routes
Route::prefix('map')->group(function () {
    Route::get('/', [MapController::class, 'show']);
    Route::get('/regions', [MapController::class, 'regions']);
    Route::get('/resources', [MapController::class, 'resources']);
});

// Battle routes
Route::prefix('battles')->group(function () {
    Route::get('/', [WarController::class, 'activeBattles']);
    Route::get('/{battle}', [WarController::class, 'battleDetails']);
    Route::post('/{battle}/move-units', [WarController::class, 'moveUnits']);
    Route::post('/{battle}/attack', [WarController::class, 'attack']);
});
