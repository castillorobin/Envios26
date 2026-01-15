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
        Schema::create('repartidors', function (Blueprint $table) {
            $table->id();
            $table -> string  ('nombre',150);
            $table -> string  ('direccion',300);
            $table -> string  ('telefono', 15); 
            $table -> string  ('dui', 25);
            $table -> string  ('nit', 35);
            $table -> string  ('tipo_contrato',25)->nullable();
            $table -> string  ('agencia',25)->nullable();
            $table -> string  ('num_seguro',35)->nullable();
            $table -> string  ('num_afp',35)->nullable();
            $table -> string  ('cargo',50);
            $table -> date    ('fecha_de_alta')->nullable();
            $table -> float   ('salario')->nullable();
            $table -> date    ('fecha_de_baja')->nullable();
            $table -> text    ('nota')->nullable();
            $table -> string  ('tipo_vehiculo',35)->nullable();
            $table -> string  ('asigno_unidad',5)->nullable();
            $table -> string  ('num_placa',25)->nullable();
            $table -> string  ('num_tarjeta',25)->nullable();
            $table -> string  ('num_licencia',25)->nullable();
            $table -> string  ('correo',25)->nullable();
            $table -> string  ('foto')->nullable();   
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
        Schema::dropIfExists('repartidors');
    }
};
