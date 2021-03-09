<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\VehiclesController;
use App\Http\Controllers\api\PricePermanenceVehiclesController;
use App\Http\Controllers\api\UsersController;

Route::apiResource('user', UsersController::class);
Route::apiResource('vehicles', VehiclesController::class);
Route::apiResource('price-permanence-vehicles', PricePermanenceVehiclesController::class);


/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

