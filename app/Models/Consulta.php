<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed idConsulta
 * @method findOrFail(mixed $idConsulta)
 */
class Consulta extends Model
{
    use HasFactory;

    protected $primaryKey = 'idConsulta';
    protected $fillable = [
        'user_id', 'idEspecialidade', 'conteudoConsulta', 'dataConsulta'
    ];
    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:s',
        'updated_at' => 'datetime:d/m/Y H:s',
        'dataConsulta' => 'datetime:d/m/Y H:s',
    ];

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
