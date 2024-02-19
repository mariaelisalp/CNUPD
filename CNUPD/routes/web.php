<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;

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
//Listar
Route::get('/pessoas/desaparecidos', [PeopleController::class, 'index_desaparecidos'])->name('people.index_desaparecidos');
Route::get('/pessoas/nao_identificados', [PeopleController::class, 'index_nao_identificados'])->name('people.index_nao_identificados');

//cadastrar pessoa
Route::get('/pessoas/cadastrar', [PeopleController::class, 'create'])->name('people.create');
Route::post('/pessoas/store', [PeopleController::class, 'store'])->name('people.store');

//Mostrar detalhes
Route::get('pessoas/show-desaparecido{people}', [PeopleController::class, 'show_desaparecido'])->name('people.show_desaparecido');
Route::get('pessoas/show-nao-identificado{people}', [PeopleController::class, 'show_nao_identificado'])->name('people.show_nao_identificado');

Route::get('/pessoas/cadastrar/buscar-cidades/{state_id}', [PeopleController::class, 'searchCities']);

Route::get('/pessoas/edit/{people}', [PeopleController::class, 'edit'])->name('people.edit');
Route::put('/pessoas/update/{people}', [PeopleController::class, 'update'])->name('people.update');

Route::get('/', function () {
    return view('welcome');
});
