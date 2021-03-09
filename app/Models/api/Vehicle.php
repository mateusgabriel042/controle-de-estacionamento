<?php

namespace App\Models\API;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model {
    //use HasFactory;
	public $timestamps = false;
    protected $table = 'vehicles';
    protected $fillable = ['id', 'veh_plate', 'veh_model', 'veh_brand', 'veh_color', 'veh_price_permanence', 'veh_hour_enter', 'veh_hour_out', 'id_price_permanence_vehiculo'];
}
