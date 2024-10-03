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
        Schema::create('electros', function (Blueprint $table) {
            $table->bigIncrements('id_electro'); // Clé primaire pour la table electro
            $table->string('type');
            $table->float('puissance');
            $table->float('duree');
            $table->float('consomation');

            // Clé étrangère pour la table logements
            $table->unsignedBigInteger('logement_id'); // Utiliser un nom plus explicite pour la clé étrangère

            // Définir la relation de clé étrangère avec la table logements
            $table->foreign('logement_id')->references('id')->on('logements')->onDelete('cascade');

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
        Schema::dropIfExists('electros');
    }
};
