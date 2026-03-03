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
        Schema::create('detallecajas', function (Blueprint $table) {
            $table->id();
            $table->string('cajero')->nullable();
            $table->string('agencia')->nullable();
            $table->string('concepto')->nullable();
            $table->string('tipo')->nullable();
            $table->decimal('valor', 10, 2)->nullable();
            $table->decimal('saldo', 10, 2)->nullable();
            $table->integer('idcaja')->nullable();
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
        Schema::dropIfExists('detallecajas');
    }
};
