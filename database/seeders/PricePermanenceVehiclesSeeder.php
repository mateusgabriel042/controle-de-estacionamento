<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\api\PricePermanenceVehicle as PermanenceVehicle;

class PricePermanenceVehiclesSeeder extends Seeder {
    public function run() {
        PermanenceVehicle::create([
        	'ppv_type_vehicle' => 'car',
        	'ppv_qtd_hours' => '1',
        	'ppv_price' => '5.00',
    	]);
    }
}
