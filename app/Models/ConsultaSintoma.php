<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultaSintoma extends Model
{
    use HasFactory;
    protected $table = 'consultas_sintomas';
    protected $fillable = [
       'user_id', 'idSintoma', 'idConsulta'
    ];
}
