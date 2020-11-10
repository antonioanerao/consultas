<?php

namespace App\Http\Controllers;

use App\Http\Requests\SintomaRequest;
use App\Models\Sintoma;
use Illuminate\Http\Request;

class SintomaController extends Controller
{
    /**
     * @var Sintoma
     */
    private $sintoma;

    public function __construct(Sintoma $sintoma) {
        $this->middleware('auth');
        $this->sintoma = $sintoma;
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
}
