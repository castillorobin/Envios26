<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cajon extends Model
{
    protected $fillable = ['numero'];
    use HasFactory;
}
