<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carbon_footprints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('energyconsumption_id')->constrained('energy_consumptions')->onDelete('cascade');
            $table->float('electricity_carbon_emission')->nullable(); // kg de CO2
            $table->float('gas_carbon_emission')->nullable();         // kg de CO2
            $table->float('water_carbon_emission')->nullable();       // kg de CO2
            $table->float('heating_oil_carbon_emission')->nullable(); // kg de CO2
            $table->float('total_carbon_footprint')->nullable();      // Total kg de CO2
            $table->float('carbon_saving')->nullable();               // CO2 économisé en kg
            $table->date('calculation_date');                         // Date du calcul
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carbon_footprints');
    }
};
