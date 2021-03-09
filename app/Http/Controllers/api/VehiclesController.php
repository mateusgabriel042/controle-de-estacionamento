<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\api\Vehicle;

class VehiclesController extends Controller {
    public function index() {
        return Vehicle::all();
    }

    public function store(Request $request) {
        Vehicle::create($request->all());
    }

    public function show($id) {
        return Vehicle::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $vehicleSelected = Vehicle::findOrFail($id);
        $vehicleSelected->update($request->all());
    }

    public function destroy($id) {
        $vehicleSelected = Vehicle::findOrFail($id);
        $vehicleSelected->delete();
    }
}
