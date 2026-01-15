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
        Schema::create('filtroganan', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_entrega')->nullable();
            $table->double('Personalizado')->nullable();
            $table->double('Punto_fijo')->nullable();
            $table->double('Casillero')->nullable();
            $table->double('Casillero_depa')->nullable();
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
        Schema::dropIfExists('filtroganan');
    }
};
