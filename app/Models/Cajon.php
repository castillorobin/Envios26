<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cajon extends Model
{
    protected $fillable = ['numero', 'usuario', 'rack', 'nivel', 'ubicacion'];
    use HasFactory;

    // Guías dentro de esta caja (se asocian por el número de caja)
public function guias() {
    return $this->hasMany(Orden::class, 'caja', 'numero');
}
}
