<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
    use HasFactory;

    public function datosComercio()
    {
        // 'comercio' es el nombre de la columna que guarda el ID en tu tabla recepcions
        return $this->belongsTo(Comercio::class, 'comercio', 'id');
    }

    
}
