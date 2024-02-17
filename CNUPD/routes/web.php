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
Route::get('/pessoas', [PeopleController::class, 'index'])->name('people.index');

//cadastrar pessoa desaparecida
Route::get('/pessoas/cadastrar', [PeopleController::class, 'create'])->name('people.create');
Route::post('/pessoas/store', [PeopleController::class, 'store'])->name('people.store');
Route::get('pessoas/show', [PeopleController::class, 'show'])->name('people.show');

Route::get('/pessoas/cadastrar/buscar-cidades/{state_id}', [PeopleController::class, 'searchCities']);


Route::get('/', function () {
    return view('welcome');
});
