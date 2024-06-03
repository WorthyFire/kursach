<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoffeeshopController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// Маршруты для аутентификации
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Маршрут для выхода из системы защищен аутентификацией
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Маршруты для кофейни
    Route::get('/coffeeshops', [CoffeeshopController::class, 'index']);
    Route::get('/coffeeshops/{id}', [CoffeeshopController::class, 'show']);
    Route::post('/coffeeshops', [CoffeeshopController::class, 'store']);
    Route::put('/coffeeshops/{id}', [CoffeeshopController::class, 'update']);
    Route::delete('/coffeeshops/{id}', [CoffeeshopController::class, 'destroy']);

    // Маршруты для напитков
    Route::get('/drinks', [DrinkController::class, 'index']);
    Route::get('/drinks/{id}', [DrinkController::class, 'show']);
    Route::post('/drinks', [DrinkController::class, 'store']);
    Route::put('/drinks/{id}', [DrinkController::class, 'update']);
    Route::delete('/drinks/{id}', [DrinkController::class, 'destroy']);

    // Маршруты для отзывов
    Route::get('/reviews', [ReviewController::class, 'index']);
    Route::get('/reviews/{id}', [ReviewController::class, 'show']);
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::put('/reviews/{id}', [ReviewController::class, 'update']);
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);
});
