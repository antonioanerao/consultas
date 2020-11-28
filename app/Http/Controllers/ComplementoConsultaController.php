<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplementoConsultaRequest;
use App\Models\ComplementoConsulta;
use App\Models\Consulta;
use Illuminate\Http\Request;

class ComplementoConsultaController extends Controller
{
    /**
     * @var ComplementoConsulta
     */
    private $complementoConsulta;

    public function __construct(ComplementoConsulta $complementoConsulta) {
        $this->middleware('auth');
        $this->complementoConsulta = $complementoConsulta;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param ComplementoConsultaRequest $request
     * @param Consulta $consulta
     * @return void
     */
    public function store(ComplementoConsultaRequest $request, Consulta $consulta)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['idConsulta'] = $consulta->idConsulta;
        $this->complementoConsulta->create($data);
        return back()->with('sucesso', 'Complemento adicionado com sucesso');

    }
}
