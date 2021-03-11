<?php

namespace App\Http\Controllers\api;

use Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\api\PricePermanenceVehicle as PricePermanence;

class PricePermanenceVehiclesController extends Controller {
    public function index() {
        if (!Auth('api')->user()->hasPermissionTo('view_permanence_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);
        return PricePermanence::all();
    }

    public function store(Request $request) {
        if (!Auth('api')->user()->hasPermissionTo('create_permanence_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);
        PricePermanence::create($request->all());
    }

    public function show($id) {
        if (!Auth('api')->user()->hasPermissionTo('view_permanence_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);
        return PricePermanence::findOrFail($id);
    }

    public function update(Request $request, $id) {
        if (!Auth('api')->user()->hasPermissionTo('edit_permanence_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);
        $pricePermanenceSelected = PricePermanence::findOrFail($id);
        $pricePermanenceSelected->update($request->all());
    }

    public function destroy($id) {
        if (!Auth('api')->user()->hasPermissionTo('delete_permanence_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);
        $pricePermanenceSelected = PricePermanence::findOrFail($id);
        $pricePermanenceSelected->delete();
    }
}
