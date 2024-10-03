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
        Schema::create('sources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom_renouv'); 
            $table->text('desc_renouv'); 
            $table->float('puissMax_renouv'); 
            $table->date('date_renouv'); 
            $table->string('typeE_renouv'); 
            $table->float('prodEstime_renouv'); 
            $table->decimal('coutInstall_renouv', 10, 2); 
            $table->float('impactCO2_renouv'); 
            $table->string('proprio_renouv'); 
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
        Schema::dropIfExists('sources');
    }
};
