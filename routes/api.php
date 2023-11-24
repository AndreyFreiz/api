<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AppController;

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

// Группа маршрутов для партнеров
Route::prefix('partners')->group(function () {
    Route::post('/', [PartnerController::class, 'store']);
    Route::get('/', [PartnerController::class, 'index']);
    Route::get('/slug/{slug}', [PartnerController::class, 'showBySlug']);
    Route::get('/{id}', [PartnerController::class, 'show']);
    Route::patch('/{id}', [PartnerController::class, 'update']);
    Route::delete('/{id}', [PartnerController::class, 'destroy']);
});


// Группа маршрутов для категорий
Route::prefix('categories')->group(function () {
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/slug/{slug}', [CategoryController::class, 'showBySlug']);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::patch('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});


// Группа маршрутов для приложений
Route::prefix('apps')->group(function () {
    Route::post('/', [AppController::class, 'store']);
    Route::get('/', [AppController::class, 'index']);
    Route::get('/slug/{slug}', [AppController::class, 'showBySlug']);
    Route::get('/{id}', [AppController::class, 'show']);
    Route::post('/{id}', [AppController::class, 'update']);
    Route::delete('/{id}', [AppController::class, 'destroy']);
});
