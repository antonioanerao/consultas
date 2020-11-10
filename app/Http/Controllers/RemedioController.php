<?php

namespace App\Http\Controllers;

use App\Http\Requests\RemedioRequest;
use App\Models\Remedio;
use Illuminate\Http\Request;

class RemedioController extends Controller
{
    /**
     * @var Remedio
     */
    private $remedio;

    public function __construct(Remedio $remedio) {
        $this->middleware('auth');
        $this->remedio = $remedio;
    }

    public function index() {

    }

    public function store(RemedioRequest $request) {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        $remedio = $this->remedio
            ->where('user_id', '=', auth()->user()->id)
            ->where('nomeRemedio', '=', $data['nomeRemedio'])
            ->first();

        try{
            if(!$remedio) {
                return Remedio::create($data);
            }
        }catch(\Exception $exception) {
            return $exception->getMessage();
        }

        return response()->json('Este remedio já está cadastrada', 422);
    }
}
