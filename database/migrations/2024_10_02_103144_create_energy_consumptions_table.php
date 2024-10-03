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
        Schema::create('energy_consumptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->float('electricity_consumption')->nullable(); // kWh
            $table->float('gas_consumption')->nullable();         // m³
            $table->float('heating_oil_consumption')->nullable(); // litres
            $table->float('solar_energy_generated')->nullable();  // kWh
            $table->enum('period', ['monthly', 'semiannual', 'annual'])->default('monthly'); // Périodicité de la consommation

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
        Schema::dropIfExists('energy_consumptions');
    }
};
