<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
    'usuario_id',
    'fecha_pago',
    'subtotal',
    'descuento',
    'nota_descuento',
    'total',
    'estado',
    'comercio', 
    'recepcion_id'
];
}
