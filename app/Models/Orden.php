<?php

namespace App\Models;
use App\Models\Comercio;

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
        'estado',
        'cobro',
        'precio',
        'envio',
        'punto',
        'foto1', 
        'foto2', 
        'foto3',
        'caja',
        'rack',
        'nivel',
        'gondola',
        'entrega',
        'pago',
        'agencia'
    ];

    public function comercioRel() {
    return $this->belongsTo(Comercio::class, 'comercio'); // 'comercio' es el FK en tu tabla ordens
}
public function recepcion()
    {
        // Argumentos: Modelo relacionado, clave foránea en Orden, clave local en Recepcion
        return $this->belongsTo(Recepcion::class, 'recepcion_id', 'id');
    }
}
