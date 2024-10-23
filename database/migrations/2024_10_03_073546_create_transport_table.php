<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transports', function (Blueprint $table) {
            $table->bigIncrements('id'); // Use 'id' as the default primary key
            $table->string('consommateur'); 
            $table->string('type'); // Type of transport (e.g., voiture, vélo)
            $table->float('distance'); // Distance travelled
            $table->float('emissions_CO2'); // CO2 emissions
            $table->float('cost'); // Cost of the transport
            $table->float('duration'); // Duration of the transport
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
        Schema::dropIfExists('transports');
    }
};
