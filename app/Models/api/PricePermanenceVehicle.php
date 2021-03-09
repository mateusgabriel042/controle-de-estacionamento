<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricePermanenceVehicle extends Model {
    use HasFactory;
    public $timestamps = false;
    protected $table = 'price_permanence_vehicle';
    protected $fillable = ['id', 'ppv_type_vehicle', 'ppv_qtd_hours' , 'ppv_price'];
}
