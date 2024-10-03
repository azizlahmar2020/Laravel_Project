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
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // nom du fournisseur
            $table->enum('type', [
                'Coal',
                'Oil',
                'Natural Gas',
                'Nuclear',
                'Other', // Vous pouvez ajouter d'autres types d'énergie non renouvelable ici
            ]); // type d’énergie
            $table->decimal('tarif', 10, 2); // tarif
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
        Schema::dropIfExists('fournisseurs');
    }
};
