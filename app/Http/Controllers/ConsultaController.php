<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultaRequest;
use App\Models\Consulta;
use App\Models\Especialidade;
use App\Models\Remedio;
use App\Models\Sintoma;

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
    private $sintoma;
    /**
     * @var Remedio
     */
    private $remedio;

    public function __construct(Consulta $consulta, Especialidade $especialidade, Sintoma $sintoma, Remedio $remedio) {
        $this->middleware('auth');
        $this->consulta = $consulta;
        $this->especialidade = $especialidade;
        $this->sintoma = $sintoma;
        $this->remedio = $remedio;
    }

    public function index() {
        //
    }

    public function listaEspecialidade() {

    }

    public function create() {
        $listaEspecialidades = [];
        $especialidades = $this->especialidade->where('user_id', '=', auth()->user()->id)->get();

        /* Monta uma lista de especialidades */
        foreach($especialidades as $e) { $listaEspecialidades[$e->idEspecialidade] =
            $e->nomeEspecialidade; $listaEspecialidades = array('' => 'Escolha uma especialidade')+$listaEspecialidades; }

        $sintomas = $this->sintoma->where('user_id', '=', auth()->user()->id)->pluck('nomeSintoma', 'idSintoma');
        $remedios = $this->remedio->where('user_id', '=', auth()->user()->id)->pluck('nomeRemedio', 'idRemedio');

        return view('consulta.create', compact('listaEspecialidades', 'sintomas', 'remedios'));
    }

    public function store(ConsultaRequest $request) {
        $data[] = $request->all();
        $data['user_id'] = auth()->user()->id;
    }
}
