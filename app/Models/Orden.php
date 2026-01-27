<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;
    protected $fillable = [
        'guia',
        'comercio',
        'direccion',
        'destinatario',
        'telefono',
        'whatsapp',
        'tipo',
        'destino',
        'fecha_entrega',
        'total',
        'nota',
    ];
}
