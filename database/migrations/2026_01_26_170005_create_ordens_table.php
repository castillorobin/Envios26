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
        Schema::create('ordens', function (Blueprint $table) {
            $table->id();
            $table->string('guia')->nullable();
            $table->string('comercio')->nullable();
            $table->string('direccion')->nullable();
            $table->string('destinatario')->nullable();
            $table->string('tipo')->nullable();
            $table->string('destino')->nullable();
            $table->string('telefono')->nullable();
            $table->string('whatsapp')->nullable();
            $table->date('fecha_entrega')->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->string('nota')->nullable();
            $table->string('estado')->nullable();
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
        Schema::dropIfExists('ordens');
    }
};
