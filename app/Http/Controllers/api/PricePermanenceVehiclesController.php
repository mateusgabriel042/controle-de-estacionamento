<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\api\PricePermanenceVehicle as PricePermanence;
use App\Models\api\Vehicle;

class PricePermanenceVehiclesController extends Controller {
    //listagem da permanencia do veiculo
    public function index() {
        //verificacao de acesso
        if (!Auth('api')->user()->hasPermissionTo('view_permanence_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);

        //retorno das permanencias registradas
        return response()->json([
            'permanences' => PricePermanence::all()
        ]);
    }

    //registro da permanencia do veiculo
    public function store(Request $request) {
        //verificacao de acesso
        if (!Auth('api')->user()->hasPermissionTo('create_permanence_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);
        
        //registracao da permanencia
        $permanenceVehicle = PricePermanence::create($request->all());

        //retorno do registro da permanencia
        return response()->json([
            'message' => 'Permanence vehicle successfully registered!',
            'permanenceVehicle' => $permanenceVehicle
        ], 200);
    }

    //selecao da permanencia do veiculo
    public function show($id) {
        //verificacao de acesso
        if (!Auth('api')->user()->hasPermissionTo('view_permanence_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);

        //selecao da permanencia
        try{
            $permanenceVehicleSelected = PricePermanence::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error' => 'Permanence vehicle not found!'], 404);
        }

        //retorno da permanencia em json
        return response()->json([
            'permanenceVehicle' => $permanenceVehicleSelected
        ]);
    }

    //atualizacao da permanencia do veiculo
    public function update(Request $request, $id) {
        //verificacao de acesso
        if (!Auth('api')->user()->hasPermissionTo('edit_permanence_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);
        
        //selecao da permanencia
        try{
            $permanenceVehicleSelected = PricePermanence::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error' => 'Permanence vehicle not found!'], 404);
        }

        //atualizacao da permanencia
        $permanenceVehicleSelected->update($request->all());

        //retorno da permanencia do veiculo deletado em json
        return response()->json([
            'message' => 'Permanence vehicle successfully updated!',
            'permanenceUpdated' => $permanenceVehicleSelected
        ], 200);
    }

    //deletacao da permanencia do veiculo
    public function destroy($id) {
        //verificacao de acesso
        if (!Auth('api')->user()->hasPermissionTo('delete_permanence_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);
        
        //selecao da permanencia
        try{
            $permanenceVehicleSelected = PricePermanence::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error' => 'Permanence vehicle not found!'], 404);
        }

        //deletando todos os veiculos que tem relacao com a permanencia selecionada
        foreach (Vehicle::all() as $vehicle) {
            if($vehicle['id_price_permanence_vehiculo'] == $permanenceVehicleSelected['id'])
                $vehicle->delete();
        }
        
        //deletando a permanencia
        $permanenceVehicleSelected->delete();

        //retorno da permanencia do veiculo deletado em json
        return response()->json([
            'message' => 'Permanence vehicle successfully deleted!',
            'permanenceDeleted' => $permanenceVehicleSelected
        ], 200);
    }
}
