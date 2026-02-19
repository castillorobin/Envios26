<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    use HasFactory;
    protected $fillable = ['codigo', 'subtotal', 'descuento', 'nota', 'metodo', 'usuario'];
}
