<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultaRequest;
use App\Models\Consulta;
use App\Models\ConsultaRemedio;
use App\Models\ConsultaSintoma;
use App\Models\Especialidade;
use App\Models\Remedio;
use App\Models\Sintoma;
use Illuminate\Support\Facades\DB;

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
    /**
     * @var ConsultaSintoma
     */
    private $consultaSintoma;
    /**
     * @var ConsultaRemedio
     */
    private $consultaRemedio;

    public function __construct(
            Consulta $consulta, Especialidade $especialidade, Sintoma $sintoma, Remedio $remedio,
            ConsultaSintoma $consultaSintoma, ConsultaRemedio $consultaRemedio
        ) {
        $this->middleware('auth');
        $this->consulta = $consulta;
        $this->especialidade = $especialidade;
        $this->sintoma = $sintoma;
        $this->remedio = $remedio;
        $this->consultaSintoma = $consultaSintoma;
        $this->consultaRemedio = $consultaRemedio;
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
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $sintomas = request('idSintoma');
        $remedios = request('idRemedio');

        try{
            $this->consulta->create($data);
            $idConsulta = DB::getPdo()->lastInsertId();
        }catch(\Exception $exception) {
            return back()->with('erro', 'O cadastro falou com o código '. $exception->getCode());
        }

        if($sintomas) {
            $contadorSintomas = count($sintomas);
            for($b=0;$b<$contadorSintomas;$b++) {
                $this->consultaSintoma->create([
                    'user_id' => auth()->user()->id,
                    'idSintoma'=>$sintomas[$b],
                    'idConsulta'=>$idConsulta,
                ]);
            }
        }

        if($remedios) {
            $contadorRemedios = count($remedios);
            for($a=0;$a<$contadorRemedios;$a++) {
                $this->consultaRemedio->create([
                    'user_id' => auth()->user()->id,
                    'idRemedio'=>$remedios[$a],
                    'idConsulta'=>$idConsulta,
                ]);
            }
        }

       return redirect(route('consulta.edit', $idConsulta))->with('sucesso', 'Consulta cadastrada com sucesso!');
    }

    public function edit($id) {
        return view('consulta.edit');
    }
}
