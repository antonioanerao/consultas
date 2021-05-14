<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplementoConsulta extends Model
{
    use HasFactory;

    protected $fillable = [
        'idConsulta', 'user_id', 'conteudoComplementoConsulta'
    ];

    protected $dateFormat = 'd/m/Y H:s:i';

    public static function destroy($ids) {
        //Recebe a função original do Model e adiciona um return back
        parent::destroy($ids);
        return back()->with('sucesso', 'Complemento removido com sucesso');
    }
}
