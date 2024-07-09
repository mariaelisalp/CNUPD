<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\UserRequestController;

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

Route::get('pessoas/show/{people}', [PeopleController::class, 'show'])->name('people.show');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/serviços/registro', function () {
    return view('static.peopleRegister');
});

Route::get('/faq', function () {
    return view('static.faq');
});

Route::get('/contatos', function () {
    return view('static.contacts');
});

Route::get('/pessoas/cadastrar/buscar-cidades/{state_id}', [PeopleController::class, 'searchCities']);

Route::middleware(['auth'])->group(function () {
    Route::get('/pessoas/cadastrar', [PeopleController::class, 'create'])->name('people.create');
    Route::post('/pessoas/store', [PeopleController::class, 'store'])->name('people.store');
    Route::get('/pessoas/edit/{people}', [PeopleController::class, 'edit'])->name('people.edit');
    Route::put('/pessoas/update/{people}', [PeopleController::class, 'update'])->name('people.update');
    Route::delete('/pessoas/delete/{people}', [PeopleController::class, 'delete'])->name('people.delete');
    
});

Route::middleware(['admin'])->group(function () {
    /* Route::get('admin', function(){
        dd('Você é admin');
    }); */
    Route::get('/admin/index', [UserRequestController::class, 'index_requisicoes'])->name('admin.index_requisicoes');
    Route::get('/admin/index/exibe_requisicao/{user_requests}', [UserRequestController::class, 'exibe_requisicao'])->name('admin.exibe_requisicao');
    Route::post('/admin/index/aprova/{user_requests}', [UserRequestController::class, 'aprova_requisicao'])->name('admin.aprova_requisicao');
    Route::delete('/admin/index/reprova/{user_requests}', [UserRequestController::class, 'rejeita_requisicao'])->name('admin.rejeita_requisicao');
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
