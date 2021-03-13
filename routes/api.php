<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\VehiclesController;
use App\Http\Controllers\api\PricePermanenceVehiclesController;
use App\Http\Controllers\api\UsersController;


//criacao das rotas da API de autenticacao
Route::post('auth/login', ['as' => 'login', AuthController::class, 'login']);
Route::post('auth/register', ['as' => 'register', AuthController::class, 'register']);
Route::group([
    'middleware' => 'apiJwt',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/logout', ['as' => 'logout', AuthController::class, 'logout']);
    Route::post('/refresh', ['as' => 'refresh', AuthController::class, 'refresh']);
    Route::get('/user-profile', ['as' => 'user-profile', AuthController::class, 'userProfile']);       
});


Route::group([
    'middleware' => 'apiJwt'
], function ($router) {
    Route::apiResource('users', UsersController::class);
	Route::apiResource('vehicles', VehiclesController::class);
	Route::put('vehicles/end-permanence/{idVehicle}', [VehiclesController::class, 'endPermanence']);//rota para finalizar a permanencia dos veiculos
	Route::apiResource('price-permanence-vehicles', PricePermanenceVehiclesController::class);
});



