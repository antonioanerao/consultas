<?php

namespace App\Http\Controllers;

use App\Http\Requests\EspecialidadeRequest;
use App\Models\Especialidade;

class EspecialidadeController extends Controller
{
    /**
     * @var Especialidade
     */
    private $especialidade;

    public function __construct(Especialidade $especialidade) {
        $this->middleware('auth');
        $this->especialidade = $especialidade;
    }

    public function store(EspecialidadeRequest $request) {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        $especialidade = $this->especialidade
            ->where('user_id', '=', auth()->user()->id)
            ->where('nomeEspecialidade', '=', $data['nomeEspecialidade'])
            ->first();

        try{
            if(!$especialidade) {
                return Especialidade::create($data);
            }
        }catch(\Exception $exception) {
            return $exception->getMessage();
        }

        return response()->json('Especialidade já está cadastrada', 422);
    }
}
