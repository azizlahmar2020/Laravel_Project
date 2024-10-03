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
        Schema::create('factures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('consommateur'); 
            $table->date('date_facture');
            $table->integer('periode_facture'); 
            $table->double('consommation_totale'); 
            $table->double('prix_unitaire'); 
            $table->double('montant_totale'); 
            $table->string('type_energie'); 
            $table->double('emission_carbone'); 
            $table->string('moyen_paiement');
            $table->string('statut'); 
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
        Schema::dropIfExists('factures');
    }
};
