<?php

use App\Http\Controllers\ComplementoConsultaController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\EspecialidadeController;
use App\Http\Controllers\RemedioController;
use App\Http\Controllers\SintomaController;
use App\Http\Controllers\UserController;
use App\Models\ComplementoConsulta;
use App\Models\Especialidade;
use App\Models\Remedio;
use App\Models\Sintoma;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function() {
    return redirect(route('dashboard'));
});

Route::group(['prefix' => 'painel'], function() {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('consulta', [ConsultaController::class, 'index'])->name('consulta.index');
    Route::get('consulta/create', [ConsultaController::class, 'create'])->name('consulta.create');
    Route::post('consulta/store', [ConsultaController::class, 'store'])->name('consulta.store');
    Route::get('consulta/{consulta}/edit', [ConsultaController::class, 'edit'])->name('consulta.edit');
    Route::get('consulta/{consulta}/show', [ConsultaController::class, 'show'])->name('consulta.show');
    Route::post('consulta/{consulta}/update', [ConsultaController::class, 'update'])->name('consulta.update');
    /* Remover Complemento de Consulta */
    Route::delete('consulta/complemento/remover/{id}', [ComplementoConsulta::class, 'destroy'])
        ->name('consulta.complemento.destroy')->middleware('auth');
    Route::resource('especialidade', EspecialidadeController::class);
    Route::resource('sintoma', SintomaController::class);
    Route::resource('remedio', RemedioController::class);

    Route::post('consulta/{consulta}/complemento/store', [ComplementoConsultaController::class, 'store'])->name('complemento.store');

    /* Retornos Json */
    Route::get('lista-especialidade-json', function() {
        if(!auth()->guest()) {
            $data = Especialidade::where('user_id', '=', auth()->user()->id)->orderBy('nomeEspecialidade', 'desc')->get();
            return response()->json($data, 200);
        }
        return response()->json('error', '200');
    })->name('listaEspecialidadeJson');

    Route::get('lista-sintoma-json', function() {
        if(!auth()->guest()) {
            $data = Sintoma::where('user_id', '=', auth()->user()->id)->orderBy('nomeSintoma', 'desc')->get();
            return response()->json($data, 200);
        }
        return response()->json('error', '200');
    })->name('listaSintomaJson');

    Route::get('lista-remedio-json', function() {
        if(!auth()->guest()) {
            $data = Remedio::where('user_id', '=', auth()->user()->id)->orderBy('nomeRemedio', 'desc')->get();
            return response()->json($data, 200);
        }
        return response()->json('error', '200');
    })->name('listaRemedioJson');
});
