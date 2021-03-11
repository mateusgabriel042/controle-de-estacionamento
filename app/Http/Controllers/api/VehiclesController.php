<?php

namespace App\Http\Controllers\api;
use Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\api\Vehicle;

class VehiclesController extends Controller {

    public function index() {
        if (!Auth('api')->user()->hasPermissionTo('view_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);
        return Vehicle::all();
    }

    public function store(Request $request) {
        if (!Auth('api')->user()->hasPermissionTo('create_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);
        Vehicle::create($request->all());
    }

    public function show($id) {
        if (!Auth('api')->user()->hasPermissionTo('view_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);
        return Vehicle::findOrFail($id);
    }

    public function update(Request $request, $id) {
        if (!Auth('api')->user()->hasPermissionTo('edit_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);
        $vehicleSelected = Vehicle::findOrFail($id);
        $vehicleSelected->update($request->all());
    }

    public function destroy($id) {
        if (!Auth('api')->user()->hasPermissionTo('delete_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);
        $vehicleSelected = Vehicle::findOrFail($id);
        $vehicleSelected->delete();
    }
}
