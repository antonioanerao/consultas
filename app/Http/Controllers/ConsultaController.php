<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Especialidade;
use App\Models\Remedio;
use App\Models\Sintoma;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    /**
     * @var Consulta
     */
    private $consulta;
    /**
     * @var Especialidade
     */
    private $especialidade;
    /**
     * @var Sintoma
     */
    private $simtoma;
    /**
     * @var Remedio
     */
    private $remedio;

    public function __construct(Consulta $consulta, Especialidade $especialidade, Sintoma $sintoma, Remedio $remedio) {
        $this->middleware('auth');
        $this->consulta = $consulta;
        $this->especialidade = $especialidade;
        $this->simtoma = $sintoma;
        $this->remedio = $remedio;
    }

    public function index() {
        //
    }

    public function listaEspecialidade() {

    }

    public function create() {
        $especialidades = $this->especialidade->where('user_id', '=', auth()->user()->id)->pluck('nomeEspecialidade', 'idEspecialidade');
        $sintomas = $this->simtoma->pluck('nomeSintoma', 'idSintoma');

        return view('consulta.create', compact('especialidades', 'sintomas'));
    }

    public function store(Request $request) {
        return $request->all();
    }
}
