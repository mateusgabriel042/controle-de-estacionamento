<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('veh_plate')->unique();
            $table->string('veh_model');
            $table->string('veh_brand');
            $table->string('veh_color');
            $table->decimal('veh_price_permanence');
            $table->timestamp('veh_hour_enter')->useCurrent();
            $table->timestamp('veh_hour_out')->nullable();
            $table->unsignedBigInteger('id_price_permanence_vehiculo');
            $table->foreign('id_price_permanence_vehiculo')->references('id')->on('price_permanence_vehicle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
