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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->dateTime('fecha_pago');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('descuento', 10, 2)->nullable();
            $table->string('nota_descuento')->nullable();
            $table->decimal('total', 10, 2);
            $table->string('estado')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * 
     * 'usuario_id',

     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
};
