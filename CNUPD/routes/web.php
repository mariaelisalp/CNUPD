<?php

use App\Http\Controllers\ProfileController;
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
Route::get('pessoas/show/{people}', [PeopleController::class, 'show'])->name('people.show');

//Busca cidades
Route::get('/pessoas/cadastrar/buscar-cidades/{state_id}', [PeopleController::class, 'searchCities']);

//Editar registro
Route::get('/pessoas/edit/{people}', [PeopleController::class, 'edit'])->name('people.edit');
Route::put('/pessoas/update/{people}', [PeopleController::class, 'update'])->name('people.update');

Route::delete('/pessoas/delete/{people}', [PeopleController::class, 'delete'])->name('people.delete');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
