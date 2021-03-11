<?php

namespace App\Http\Controllers\api;

use Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\api\PricePermanenceVehicle as PricePermanence;

class PricePermanenceVehiclesController extends Controller {
    public function index() {
        return PricePermanence::all();
    }

    public function store(Request $request) {
        PricePermanence::create($request->all());
    }

    public function show($id) {
        return PricePermanence::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $pricePermanenceSelected = PricePermanence::findOrFail($id);
        $pricePermanenceSelected->update($request->all());
    }

    public function destroy($id) {
        $pricePermanenceSelected = PricePermanence::findOrFail($id);
        $pricePermanenceSelected->delete();
    }
}
