<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
   
    use HasFactory;

    protected $fillable = ['nombre', 'placas', 'marca', 'modelo', 'tipo', 'color', 'fecharuta', 'estado', 'repartidor'];

    // Guías directamente asociadas a la unidad (Suelto)
public function guiasDirectas() {
    return $this->hasMany(Orden::class, 'unidad', 'id');
}

// Cajas asociadas a la unidad
public function cajas() {
    return $this->hasMany(Cajon::class, 'unidad', 'id');
}
}
