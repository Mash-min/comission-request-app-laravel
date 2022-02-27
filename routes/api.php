<?php

use App\Http\Controllers\CommissionRequestImagesController;
use App\Http\Controllers\CommissionRequestsController;
use App\Http\Controllers\OfferImagesController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\UsersController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users'], function() {
    Route::post('/register', [RegisterController::class, 'create']);
    Route::post('/login', [LoginController::class, 'login']);
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::get('/', [UsersController::class, 'user']);
        Route::post('/logout', [LoginController::class, 'logout']);
        Route::put('/', [UsersController::class, 'update']);
        Route::put('/reset-password', [UsersController::class, 'resetPassword']);
        Route::get('/commission-requests', [UsersController::class, 'commissionRequests']);
        Route::get('/offers', [UsersController::class, 'offers']);
    });
});

Route::group(['prefix' => 'commission-requests', 'middleware' => 'auth:sanctum'], function() {
    Route::post('/', [CommissionRequestsController::class, 'create']);
    Route::delete('/{id}', [CommissionRequestsController::class, 'delete']);
    Route::put('/{id}', [CommissionRequestsController::class, 'update']);
    Route::get('/{id}', [CommissionRequestsController::class, 'find']);
    Route::get('/slug/{slug}', [CommissionRequestsController::class, 'viewRequest']);
    Route::get('/', [CommissionRequestsController::class, 'all']);
    Route::get('/{id}/offers', [CommissionRequestsController::class, 'offers']);
    Route::get('/search/{data}', [CommissionRequestsController::class, 'search']);
    // Add commission images
    Route::post('/images', [CommissionRequestImagesController::class, 'create']);
});

Route::group(['prefix' => 'offers', 'middleware' => 'auth:sanctum'], function() { 
    Route::post('/', [OffersController::class, 'create']);
    Route::delete('/{id}', [OffersController::class, 'delete']);
    Route::put('/{id}', [OffersController::class, 'update']);
    // Add offer images
    Route::post('/images', [OfferImagesController::class, 'create']);
});