<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\VehiclesController;
use App\Http\Controllers\api\PricePermanenceVehiclesController;


Route::post('auth/login', ['as' => 'login', AuthController::class, 'login']);
Route::group([
    'middleware' => 'apiJwt',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', ['as' => 'register', AuthController::class, 'register']);
    Route::post('/logout', ['as' => 'logout', AuthController::class, 'logout']);
    Route::post('/refresh', ['as' => 'refresh', AuthController::class, 'refresh']);
    Route::get('/user-profile', ['as' => 'user-profile', AuthController::class, 'userProfile']);    
});

Route::apiResource('vehicles', VehiclesController::class);
Route::apiResource('price-permanence-vehicles', PricePermanenceVehiclesController::class);


/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

