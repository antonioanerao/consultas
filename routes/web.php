<?php

use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\EspecialidadeController;
use App\Http\Controllers\UserController;
use App\Models\Especialidade;
use Facade\FlareClient\Http\Response;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'painel'], function() {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::resource('consulta', ConsultaController::class);
    Route::resource('especialidade', EspecialidadeController::class);

    /* Retornos Json */
    Route::get('lista-especialidade-json', function() {
        if(!auth()->guest()) {
            $data = Especialidade::where('user_id', '=', auth()->user()->id)->orderBy('nomeEspecialidade', 'desc')->get();
            return response()->json($data, 200);
        }
        return response()->json('error', '200');
    });
});
