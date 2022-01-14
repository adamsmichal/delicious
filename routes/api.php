<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
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

    Route::prefix('restaurants')->group(function() {
        Route::post('/', [RestaurantController::class, 'store']);
        Route::get('/{uuid}', [RestaurantController::class, 'show']);
        Route::put('/{uuid}', [RestaurantController::class, 'update']);
        Route::delete('/{uuid}', [RestaurantController::class, 'destroy']);
    });

    Route::group(['middleware' => ['auth:sanctum', 'role:user|restaurant_account']],(function() {
        Route::post('/logout', [AuthController::class, 'logout']);

//        Route::prefix('restaurants')->group(function() {
//            Route::post('/', [RestaurantController::class, 'store']);
//            Route::get('/{uuid}', [RestaurantController::class, 'show']);
//            Route::put('/{uuid}', [RestaurantController::class, 'update']);
//            Route::delete('/{uuid}', [RestaurantController::class, 'destroy']);
//        });

        Route::prefix('users')->group(function() {
            Route::get('/{uuid}', [UserController::class, 'show']);
            Route::put('/{uuid}', [UserController::class, 'update']);
            Route::delete('/{uuid}', [UserController::class, 'destroy']);
        });
    }));
});
