<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\People;
use App\Models\Contact;
use App\Models\City;
use App\Models\State;
use App\Models\People_Contact_City;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePeopleRequest;

class PeopleController extends Controller
{
    //listar desaparecidos
    public function index_desaparecidos(Request $request)
    {
        $people = People::select('people.id', 'people.name', 'people.missing_time_date', 'people.age', 'people.gender', 'cities.name as city', 'states.abbr as state')
        ->join('people_contacts_cities', 'people.id', '=', 'people_contacts_cities.people_id')
        ->join('cities', 'people_contacts_cities.city_id', '=', 'cities.id')
        ->join('states', 'cities.state_id', '=', 'states.id')
        ->when($request->has('search'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('people.name', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('cities.name', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('states.abbr', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('people.missing_time_date', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('people.age', '=', $request->input('search'))
                    ->orWhere('people.gender', 'like', '%' . $request->input('search') . '%');
            });
        })
        ->when($request->filled('date'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('people.missing_time_date', '=', \Carbon\Carbon::parse($request->input('date'))->format('Y-m-d'));
            });
        })
        ->where('people.missing', '=', 1)
        ->paginate(5)
        ->withQueryString();

        return view('people.index_desaparecidos', ['people' => $people, 'search' => $request->input('search'),
            'date' => $request->date]);
    }

    //listar n identificados
    public function index_nao_identificados(Request $request){
        $people = People::select('people.id', 'people.name', 'people.time_date', 'people.age', 'people.gender', 'cities.name as city', 'states.abbr as state')
        ->join('people_contacts_cities', 'people.id', '=', 'people_contacts_cities.people_id')
        ->join('cities', 'people_contacts_cities.city_id', '=', 'cities.id')
        ->join('states', 'cities.state_id', '=', 'states.id')
        ->when($request->has('search'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
            $query->where('people.name', 'like', '%' . $request->input('search') . '%')
                ->orWhere('cities.name', 'like', '%' . $request->input('search') . '%')
                ->orWhere('states.abbr', 'like', '%' . $request->input('search') . '%')
                ->orWhere('people.time_date', 'like', '%' . $request->input('search') . '%')
                ->orWhere('people.age', '=', $request->input('search')) 
                ->orWhere('people.gender', 'like', '%' . $request->input('search') . '%');
            });
        })
        ->when($request->filled('date'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('people.time_date', '=', \Carbon\Carbon::parse($request->input('date'))->format('Y-m-d'));
            });
        })
        ->where('people.missing', '=', 0)
        ->paginate(5)
        ->withQueryString();

        return view('people.index_nao_identificados', ['people' => $people, 'search' => $request->input('search'),
            'date' => $request->date]);

    }

    //criar um registro de pessoa
    public function create(){
        $states = State::all()->pluck('abbr','id');
        return view('people.create', compact('states'));
    }

    //procura cidades no banco de acordo com estado selecionado
    public function searchCities($state_id){
        $cities = City::where('state_id', $state_id)->pluck('name', 'id');
        return response()->json($cities);
    }

    //armazena dados vindo no formulário no banco
    public function store(StorePeopleRequest $request){

        //validar formulário
        $request->validated();
        
        //envia dados para tabela people
        $people = new People();
        $people->name = $request->get('name');
        $people->eye_color = $request->get('eye_color');
        $people->skin_color = $request->get('skin_color');
        $people->gender = $request->get('gender');
        $people->weight = $request->get('weight');
        $people->birth_date = $request->get('birth_date');
        $people->missing = $request->get('missing');
        $people->missing_time_date = $request->get('missing_time_date');
        $people->time_date = $request->get('time_date');
        $people->age = $request->get('age');
        $people->father_name = $request->get('father_name');
        $people->mother_name = $request->get('mother_name');
        $people->height = $request->get('height');
        $people->other_features = $request->get('other_features');
        $people->circumstances = $request->get('circumstances');
        $people->motivations = $request->get('motivations');
        $people->save();

        //envia dados para tabela contacts
        $contact = new Contact();
        $contact->name_organization = $request->get('name_organization');
        $contact->email = $request->get('email');
        $contact->number = $request->get('number');
        $contact->save();

        //chaves estrangeiras
        $personContactCity = new People_Contact_City();
        $personContactCity->people_id = $people->id;
        $personContactCity->city_id = $request->input('city');
        $personContactCity->contacts_id = $contact->id;
        $personContactCity->save();

        return redirect()->route('people.index_desaparecidos');

    }

    //Detalhes de registro
    public function show_desaparecido(People $people){
        $peopleContactCity = $people->people_contact_city;
    
        
        if ($peopleContactCity) {
            $contactInfo = $peopleContactCity->contact;
            $cityInfo = $peopleContactCity->city;
            $state = $peopleContactCity->city->state;
        }
    
        return view('people.show_desaparecido', [
            'people' => $people,
            'contactInfo' => $contactInfo,
            'cityInfo' => $cityInfo,
            'state' => $state
        ]);
    }

    public function show_nao_identificado(People $people){
        $peopleContactCity = $people->people_contact_city;
    
        
        if ($peopleContactCity) {
            $contactInfo = $peopleContactCity->contact;
            $cityInfo = $peopleContactCity->city;
            $state = $peopleContactCity->city->state;
        }
    
        return view('people.show_nao_identificado', [
            'people' => $people,
            'contactInfo' => $contactInfo,
            'cityInfo' => $cityInfo,
            'state' => $state
        ]);
    }

    public function edit(People $people){
        $states = State::all()->pluck('abbr','id');

        $peopleContactCity = $people->people_contact_city;
    
        if ($peopleContactCity) {
            $contact = $peopleContactCity->contact;
            $city = $peopleContactCity->city;
            $state = $peopleContactCity->city->state;
        }
        return view('people.edit', ['people' => $people, 
        'states' => $states,
        'contact' => $contact,
        'city' => $city,
        'state' => $state]);
    }

    public function update(StorePeopleRequest $request, People $people){
        $request -> validated();

        $people_contact_city = $people->people_contact_city;
        $contact = $people_contact_city->contact;
        $city = $people_contact_city->city;

        $people->update([
        'name' => $request->name,
        'eye_color' => $request->eye_color,
        'skin_color' => $request->skin_color,
        'gender' => $request->gender,
        'weight' => $request->weight,
        'birth_date' => $request->birth_date,
        'missing' => $request->missing,
        'missing_time_date' => $request->missing_time_date,
        'time_date' => $request->time_date,
        'age' => $request->age,
        'father_name' => $request->father_name,
        'mother_name' => $request->mother_name,
        'height' => $request->height,
        'other_features' => $request->other_features,
        'circumstances' => $request->circumstances,
        'motivations' => $request->motivations,
        ]);

        $contact->update([
            'name_organization' => $request->name_organization,
            'email' => $request->email,
            'number' => $request->number,
        ]);

        $people_contact_city->update([
            'city_id' => $request->city,   
        ]);

        return view('people.success');
    }
    
}
