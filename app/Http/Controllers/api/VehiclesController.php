<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\api\Vehicle;
use App\Models\api\PricePermanenceVehicle as PricePermanence;

class VehiclesController extends Controller {

    //listagem dos veiculos
    public function index() {
        //verificacao de acesso
        if (!Auth('api')->user()->hasPermissionTo('view_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);//retorno de erro em json
        
        //retorno dos veiculos registrados
        return response()->json([
            'vehicles' => Vehicle::all()
        ]);
    }

    //registro de veiculos
    public function store(Request $request) {
        //verificacao de acesso
        if (!Auth('api')->user()->hasPermissionTo('create_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);

        $vehicle = Vehicle::create($request->all());

        //retorno do veiculo registrado em json
        return response()->json([
            'message' => 'Vehicle successfully registered!',
            'vehicle' => $vehicle
        ], 200);
    }

    //selecao do veiculo
    public function show($id) {
        //verificacao de acesso
        if (!Auth('api')->user()->hasPermissionTo('view_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);
        
        //selecao do veiculo
        try{
            $vehicleSelected = Vehicle::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error' => 'Vehicle not found!'], 404);
        }
        
        //retorno do veiculo selecionado
        return response()->json([
            'vehicle' => $vehicleSelected
        ]);
    }

    //atualizacao do veiculo
    public function update(Request $request, $id) {
        //verificacao de acesso
        if (!Auth('api')->user()->hasPermissionTo('edit_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);
        
        //selecao de um veiculo
        try{
            $vehicleSelected = Vehicle::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error' => 'Vehicle not found!'], 404);//retorno de erro em json caso o veiculo nao seja encontrado
        }

        //atualizacao do veiculo
        $vehicleSelected->update($request->all());

        //retorno do veiculo atualizado em json
        return response()->json([
            'message' => 'Vehicle successfully updated!',
            'vehicleUpdated' => $vehicleSelected
        ], 200);
    }

    //deletacao do veiculo
    public function destroy($id) {
        //verificacao de acesso
        if (!Auth('api')->user()->hasPermissionTo('delete_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);
        
        //selecao de um veiculo
        try{
            $vehicleSelected = Vehicle::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error' => 'Vehicle not found!'], 404);//retorno de erro em json caso o veiculo nao seja encontrado
        }

        //deletando veiculo
        $vehicleSelected->delete();

        //retorno do veiculo deletado em json
        return response()->json([
            'message' => 'Vehicle successfully deleted!',
            'vehicleDeleted' => $vehicleSelected
        ], 200);
    }


    //finalizacao da permanencia do veiculo
    public function endPermanence($idVehicle){
        //verificacao de acesso
        if (!Auth('api')->user()->hasPermissionTo('edit_vehicle'))
            return response()->json(['error' => 'Unauthorized'], 403);

        //selecao do veiculo
        try{
            $vehicleSelected = Vehicle::findOrFail($idVehicle);
        }catch(ModelNotFoundException $e){
            return response()->json(['error' => 'Vehicle not found!'], 404);//retorno de erro em json caso o veiculo nao seja encontrado
        }

        //selecao da permanencia do veiculo selecionado
        try{
            $permanenceVehicleSelected = PricePermanence::findOrFail($vehicleSelected['id_price_permanence_vehiculo']);
        }catch(ModelNotFoundException $e){
            return response()->json(['error' => 'Permanence vehicle not found!'], 404);//retorno do erro caso o preco da permanencia do veiculo nao seja encontrada
        }

        //definindo o horario local na aplicacao
        date_default_timezone_set('America/Sao_Paulo');

        //adicionando a data e hora de saida do veiculo
        $vehicleSelected['veh_hour_out'] = \date("Y-m-d H:i:s");

        //calculando o preco da permanencia do veiculo, calculo utilizado: ((hora_de_entrada - hora_de_saida) * preco_da_permanencia)
        $dateInit = new \DateTime($vehicleSelected['veh_hour_enter']);
        $dateEnd = new \DateTime($vehicleSelected['veh_hour_out']);
        $vehicleSelected['veh_price_permanence'] = $dateInit->diff($dateEnd)->h * $permanenceVehicleSelected['ppv_price'];
        
        //salvando as alteracoes
        $vehicleSelected->save();

        //resposta dos dados alterados do veiculo
        return response()->json([
            'message' => 'Vehicle successfully updated!',
            'vehicleUpdated' => $vehicleSelected
        ], 200);
    }
}
