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
        Schema::create('vendedors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('tipovende')->nullable();
            $table->string('titular')->nullable();
            $table->string('cuenta')->nullable();
            $table->string('banco')->nullable();
            $table->string('tcuenta')->nullable();
            $table->string('whatsapp')->nullable();
            $table->date('falta')->nullable();
            $table->date('fbaja')->nullable();
            $table->string('correo')->nullable();
            $table->string('chivo')->nullable();
            $table->string('tmoney')->nullable();
            $table->string('empresa')->nullable();
            $table->string('giro')->nullable();
            $table->string('dui')->nullable();
            $table->string('niva')->nullable();
            $table->string('nrc')->nullable();
            $table->string('estado')->nullable();
            $table->string('agencia')->nullable();
            $table->date('fecha_ingreso')->nullable();
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
        Schema::dropIfExists('vendedors');
    }
};
