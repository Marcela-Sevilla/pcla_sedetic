<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::resource('/ambientes', App\Http\Controllers\AmbienteController::class)->middleware('auth');
Route::post('ambientes/import', [App\Http\Controllers\AmbienteController::class, 'import'])->name('ambientes.import');

Route::post('funcionarios/import', [App\Http\Controllers\FuncionarioController::class, 'import'])->name('funcionarios.import');
Route::post('funcionarios/store', [App\Http\Controllers\FuncionarioController::class, 'store'])->name('funcionarios.store');
Route::post('funcionarios/update', [App\Http\Controllers\FuncionarioController::class, 'update'])->name('funcionarios.update');
Route::get('funcionarios', [App\Http\Controllers\FuncionarioController::class, 'index'])->middleware('auth')->name('funcionarios');
Route::delete('funcionarios/{id}/{rol}', [App\Http\Controllers\FuncionarioController::class, 'destroy'])->name('funcionarios.destroy');

Route::post('/instructoresList', [App\Http\Controllers\PrestamoController::class, 'instructoresList']);
Route::post('/ambientesList', [App\Http\Controllers\PrestamoController::class, 'ambientesList']);
Route::post('prestamos/create', [App\Http\Controllers\PrestamoController::class, 'store'])->name('prestamos.create');
Route::post('prestamos/update', [App\Http\Controllers\PrestamoController::class, 'update'])->name('prestamos.update');
Route::get('prestamos/{estado_id}', [App\Http\Controllers\PrestamoController::class, 'cambiarEstado'])->middleware('auth');
Route::get('entregas/{estado_id}', [App\Http\Controllers\PrestamoController::class, 'solicitarEntrega'])->middleware('auth');
Route::get('historial', [App\Http\Controllers\PrestamoController::class, 'historial'])->middleware('auth')->name('historial');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
