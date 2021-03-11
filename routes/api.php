<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\VehiclesController;
use App\Http\Controllers\api\PricePermanenceVehiclesController;

/*use App\Http\Controllers\api\acl\RolesController;
use App\Http\Controllers\api\acl\PermissionsController;
use App\Http\Controllers\api\acl\PermissionRoleController;
use App\Http\Controllers\api\acl\RoleUserController;*/


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


/*Route::apiResource('roles', RolesController::class);
Route::apiResource('permissions', PermissionsController::class);
Route::apiResource('permission-role', PermissionRoleController::class);
Route::apiResource('roles-user', RoleUserController::class);*/

Route::apiResource('vehicles', VehiclesController::class);
Route::apiResource('price-permanence-vehicles', PricePermanenceVehiclesController::class);


/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

