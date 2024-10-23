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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id(); // Use 'id' as the primary key
            $table->text('comment'); // Comment field to store user feedback
            $table->date('date'); // Date of the feedback
            $table->string('email'); // Email of the user giving feedback
            $table->unsignedTinyInteger('rating'); // Rating from 1 to 5
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
        Schema::dropIfExists('feedback');
    }
};
