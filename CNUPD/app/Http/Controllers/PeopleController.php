<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Location;
use App\Models\People;
use App\Models\Station;
use App\Models\City_Station;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use App\Models\People_Contact_City;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePeopleRequest;
use Illuminate\Support\Facades\Log;
use App\Models\UserActionLog;

class PeopleController extends Controller
{
    //listar desaparecidos
    public function index_desaparecidos(Request $request)
    {
        $people = (new People())->getMissing($request->input('search'), $request->input('date'), 10);

        return view('people.index_desaparecidos', [
            'people' => $people,
            'search' => $request->input('search'),
            'date' => $request->input('date'),
        ]);
    }

    //listar n identificados
    public function index_nao_identificados(Request $request){
        $people = (new People())->getNotIdentified($request->input('search'), $request->input('date'), 10);

        return view('people.index_nao_identificados', [
            'people' => $people,
            'search' => $request->input('search'),
            'date' => $request->input('date'),
        ]);

    }

    //criar um registro de pessoa
    public function create(){
        $states = State::all()->pluck('abbr','id');
        return view('people.create', compact('states'));
    }

    //procura cidades no banco de acordo com estado selecionado
    public function searchCities($state_id){
        $cities = City::cities($state_id);
        return response()->json($cities);
    }

    public function registers() {
        $user = auth()->user();
        $people = User::getRegisters($user);
    
        return view('user_registros', compact('people'));
    }

    
    public function store(StorePeopleRequest $request){

        $validatedData = $request->validated();
        $fileNameToStore = People::uploadImage($request);

        $validatedData['city_id'] = $request->input('city');
        $validatedData['image'] = $fileNameToStore;

        $people = People::create($validatedData);

        $mensagem = 'Registro criado com sucesso.';

        Log::channel('user_actions')->info('Record created', ['user_id' => auth()->user()->id, 'record_id' => $people->id]);
        UserActionLog::create_log($people);

        if($people['missing'] == 1){
            return redirect()->route('people.index_desaparecidos');
       }
       else{
            return redirect()->route('people.index_nao_identificados');
       }

    }

    //Detalhes de registro
    public function show(People $people)
{
    $show = $people->getDetails($people);
    $registro = UserActionLog::getRegistro($people->id);
    $permission = $registro ? true : false;

    $details = array_merge([
        'people' => $people,
        'permission' => $permission
    ], $show);

    if (auth()->user()) {
        UserActionLog::read_log($people);
    }

    if ($people->missing == 1) {
        return view('people.show_desaparecido', $details);
    } 
    else {
        return view('people.show_nao_identificado', $details);
    }
}


    public function edit(People $people){
        $states = State::all()->pluck('abbr','id');

        $city = $people->city;
    
        if ($city) {
            $state = $city->state;
        }
        return view('people.edit', ['people' => $people, 
        'states' => $states,
        'city' => $city,
        'state' => $state,
        ]);
    }

    public function update(StorePeopleRequest $request, People $people){
        $request -> validated();
        $fileNameToStore = People::updateImage($request, $people);
        $data = $request->all();

        $data['city_id'] = $request->input('city');
        $data['image'] = $fileNameToStore; 
        $people->update($data);

        $mensagem = 'Registro editado com sucesso.';
        $request->session()->flash('success', $mensagem);

        UserActionLog::update_log($people);

        if($people->missing == 1){
            return redirect()->route('people.show', ['people' => $people->id]);
       }
       else{
            return redirect()->route('people.show', ['people' => $people->id]);
       }
    }

    public function delete(People $people){
        UserActionLog::delete_log();
       $people->delete();

       if($people->missing == 1){
            return redirect()->route('people.index_desaparecidos');
       }
       else{
            return redirect()->route('people.index_nao_identificados');
       }
       
    }
    
}
