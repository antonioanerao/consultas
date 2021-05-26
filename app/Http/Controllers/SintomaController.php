<?php

namespace App\Http\Controllers;

use App\Http\Requests\SintomaRequest;
use App\Models\Consulta;
use App\Models\ConsultaSintoma;
use App\Models\Sintoma;
use Illuminate\Http\Request;

class SintomaController extends Controller
{
    /**
     * @var Sintoma
     */
    private $sintoma;
    /**
     * @var Consulta
     */
    private $consulta;
    /**
     * @var ConsultaSintoma
     */
    private $consultaSintoma;

    public function __construct(Sintoma $sintoma, Consulta $consulta, ConsultaSintoma $consultaSintoma) {
        $this->middleware('auth');
        $this->sintoma = $sintoma;
        $this->consulta = $consulta;
        $this->consultaSintoma = $consultaSintoma;
    }

    public function store(SintomaRequest $request) {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        $sintoma = $this->sintoma
            ->where('user_id', '=', auth()->user()->id)
            ->where('nomeSintoma', '=', $data['nomeSintoma'])
            ->first();

        try{
            if(!$sintoma) {
                return Sintoma::create($data);
            }
        }catch(\Exception $exception) {
            return $exception->getMessage();
        }

        return response()->json('Este sintoma já está cadastrada', 422);
    }

    public function associarSintomaConsulta($idConsulta, Request $request) {
        $sintomas = $request->input('idSintoma');

        if($sintomas) {
            $contadorSintomas = count($sintomas);
            for($i=0;$i<$contadorSintomas;$i++) {
                $this->consultaSintoma->create([
                    'user_id' => auth()->user()->id,
                    'idSintoma'=>$sintomas[$i],
                    'idConsulta'=>$idConsulta,
                ]);
            }
        }

        return back()->with('sucesso', 'Sintomas adicionados à consulta com sucesso');
    }
}
