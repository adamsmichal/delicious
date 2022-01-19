<?php

use App\Http\Controllers\Api\MealAttributeController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\MealController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function() {
    Route::post('/login', [AuthController::class, 'login']);

    Route::prefix('users')->group(function() {
        Route::post('/', [UserController::class, 'store']);
    });

    Route::group(['middleware' => ['auth:sanctum', 'role:user|restaurant_account']],(function() {
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::prefix('users')->group(function() {
            Route::get('/{uuid}', [UserController::class, 'show']);
            Route::put('/{uuid}', [UserController::class, 'update']);
            Route::delete('/{uuid}', [UserController::class, 'destroy']);
        });

        Route::prefix('meals')->group(function() {
            Route::get('/', [MealController::class, 'index']);
            Route::post('/', [MealController::class, 'store']);
            Route::get('/{uuid}', [MealController::class, 'show']);
            Route::put('/{uuid}', [MealController::class, 'update']);
            Route::delete('/{uuid}', [MealController::class, 'destroy']);
        });

        Route::prefix('meal_attributes')->group(function() {
            Route::post('/', [MealAttributeController::class, 'store']);
            Route::put('/{uuid}', [MealAttributeController::class, 'update']);
            Route::delete('/{uuid}', [MealAttributeController::class, 'destroy']);
        });

        Route::prefix('addresses')->group(function() {
            Route::post('/', [AddressController::class, 'store']);
            Route::get('/{uuid}', [AddressController::class, 'show']);
            Route::put('/{uuid}', [AddressController::class, 'update']);
        });
    }));

    Route::group(['middleware' => ['auth:sanctum', 'role:restaurant_account']],(function() {
        Route::prefix('restaurants')->group(function() {
            Route::post('/', [RestaurantController::class, 'store']);
            Route::get('/{uuid}', [RestaurantController::class, 'show']);
            Route::put('/{uuid}', [RestaurantController::class, 'update']);
            Route::delete('/{uuid}', [RestaurantController::class, 'destroy']);
        });
    }));
});
