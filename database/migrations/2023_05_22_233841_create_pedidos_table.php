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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('vendedor');
            $table->string('direccion')->nullable();;
            $table->string('telefono')->nullable();
            $table->date('fecha_entrega')->nullable();
            $table->string('tipo')->nullable();
            $table->double('precio')->nullable();
            $table->double('envio')->nullable();
            $table->double('total')->nullable();
            $table->string('repartidor')->nullable();
            $table->string('ruta')->nullable();
            $table->string('estado')->nullable();
            $table->string('nota')->nullable();
            $table->string('destinatario');
            $table->string('pagado')->nullable();
            $table->string('servicio')->nullable();
            $table->string('ingresado')->nullable();
            $table->string('agencia')->nullable();
            $table->string('cobroenvio')->nullable();
            $table->string('estante')->nullable();
            $table->string('medio')->nullable();
            $table->string('foto')->nullable();
            $table->string('foto2')->nullable();
            $table->string('foto3')->nullable();
            $table->string('foto4')->nullable();
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
        Schema::dropIfExists('pedidos');
    }
};
