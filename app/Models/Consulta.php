<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $primaryKey = 'idConsulta';
    protected $fillable = [
        'user_id', 'idEspecialidade', 'conteudoConsulta'
    ];

//    protected $appends = ['conteudo_resumido'];
//    public function getConteudoResumidoAttribute()
//    {
//        return str_limit($this->getAttribute('conteudo'), 200, '...');
//    }

    public function remedios() {
        return $this->hasMany(ConsultaRemedio::class, 'idConsulta', 'idConsulta')
            ->join('remedios', 'remedios.idRemedio', '=', 'consultas_remedios.idRemedio');
    }

    public function sintomas() {
        return $this->hasMany(ConsultaSintoma::class, 'idConsulta', 'idConsulta')
            ->join('sintomas', 'consultas_sintomas.idSintoma', '=', 'sintomas.idSintoma');
    }

    public function especialidade() {
        return $this->hasOne(Especialidade::class, 'idEspecialidade', 'idEspecialidade');
    }
}
