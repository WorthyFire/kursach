<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoffeeshopController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Маршруты для подтверждения почты
Route::get('/email/verify', function () {
    return response()->json(['message' => 'Подтвердите свой адрес электронной почты']);
})->middleware('auth:sanctum')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])
    ->middleware(['signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return response()->json(['message' => 'Ссылка для подтверждения отправлена.']);
})->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');

// Маршруты для кофейни, доступные для всех пользователей
Route::get('/coffeeshops', [CoffeeshopController::class, 'index']);
Route::get('/coffeeshops/{id}', [CoffeeshopController::class, 'show']);

//Маршруты для напитков, доступные для всех пользователей
Route::get('/drinks', [DrinkController::class, 'index']);
Route::get('/drinks/{id}', [DrinkController::class, 'show']);

//Маршруты для отзывов, доступные для всех пользователей
Route::get('/reviews', [ReviewController::class, 'index']);
Route::get('/reviews/{id}', [ReviewController::class, 'show']);

// Маршрут для выхода из системы защищен аутентификацией
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Защищенные маршруты для кофейни
    Route::post('/coffeeshops', [CoffeeshopController::class, 'store']);
    Route::put('/coffeeshops/{id}', [CoffeeshopController::class, 'update']);
    Route::delete('/coffeeshops/{id}', [CoffeeshopController::class, 'destroy']);

    // Защищенные маршруты для напитков
    Route::post('/drinks', [DrinkController::class, 'store']);
    Route::put('/drinks/{id}', [DrinkController::class, 'update']);
    Route::delete('/drinks/{id}', [DrinkController::class, 'destroy']);

    // Защищенные маршруты для отзывов
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::put('/reviews/{id}', [ReviewController::class, 'update']);
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);

    // Маршрут для получения информации о текущем пользователе
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Маршруты для управления пользователями (доступны только администраторам)
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});
