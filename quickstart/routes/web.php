<?php


use App\Http\Controllers\CoffeeshopController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/coffeeshops', [CoffeeshopController::class, 'index']);
Route::get('/coffeeshops/{id}', [CoffeeshopController::class, 'show']);
Route::post('/coffeeshops', [CoffeeshopController::class, 'store']);
Route::put('/coffeeshops/{id}', [CoffeeshopController::class, 'update']);
Route::delete('/coffeeshops/{id}', [CoffeeshopController::class, 'destroy']);

Route::get('/drinks', [DrinkController::class, 'index']);
Route::get('/drinks/{id}', [DrinkController::class, 'show']);
Route::post('/drinks', [DrinkController::class, 'store']);
Route::put('/drinks/{id}', [DrinkController::class, 'update']);
Route::delete('/drinks/{id}', [DrinkController::class, 'destroy']);

Route::get('/reviews', [ReviewController::class, 'index']);
Route::get('/reviews/{id}', [ReviewController::class, 'show']);
Route::post('/reviews', [ReviewController::class, 'store']);
Route::put('/reviews/{id}', [ReviewController::class, 'update']);
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);
