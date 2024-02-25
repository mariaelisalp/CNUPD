<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\People;
use App\Models\Contact;
use App\Models\City;
use App\Models\State;
use App\Models\People_Contact_City;
use App\Http\Requests\StorePeopleRequest;

class PeopleController extends Controller
{

    public function create(){
        $states = State::all()->pluck('abbr','id');
        return view('people.create', compact('states'));
    }

    public function searchCities($state_id){
        $cities = City::where('state_id', $state_id)->pluck('name', 'id');
        return response()->json($cities);
    }

    public function store(StorePeopleRequest $request){

        //validar formulário
        $request->validated();


        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noImage';
        }
        
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
        $people->image = $fileNameToStore;
        $people->save();

        //chaves estrangeiras
        $personContactCity = new People_Contact_City();
        $personContactCity->people_id = $people->id;
        $personContactCity->city_id = $request->input('city');
        $personContactCity->save();

        return view('welcome');

    }
   
}
