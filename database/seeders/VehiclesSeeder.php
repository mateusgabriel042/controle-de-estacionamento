<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\api\Vehicle;

class VehiclesSeeder extends Seeder {
    public function run() {

    	Vehicle::create([
    		'veh_plate' => '654jfx',
        	'veh_model' => 'Onix plus',
        	'veh_brand' => 'Chevrolet',
        	'veh_color' => 'White',
        	'veh_price_permanence' => '5.00',
        	'veh_hour_enter' => date("Y-m-d H:i:s"),
        	'id_price_permanence_vehiculo' => '1',
    	]);

    	Vehicle::create([
    		'veh_plate' => '342liv',
        	'veh_model' => 'Uno',
        	'veh_brand' => 'FIAT',
        	'veh_color' => 'White',
        	'veh_price_permanence' => '5.00',
        	'veh_hour_enter' => date("Y-m-d H:i:s"),
        	'id_price_permanence_vehiculo' => '1',
    	]);
    }
}
