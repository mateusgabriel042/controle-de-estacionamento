<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricePermanenceVehicle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_permanence_vehicle', function (Blueprint $table) {
            $table->id();
            $table->string('ppv_type_vehicle')->unique();
            $table->smallInteger('ppv_qtd_hours')->default(1);
            $table->decimal('ppv_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_permanence_vehicle');
    }
}
