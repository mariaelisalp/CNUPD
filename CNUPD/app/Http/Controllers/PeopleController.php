<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\People;
use App\Models\Contact;
use App\Models\People_Contact_Location;

class PeopleController extends Controller
{
    public function index(){
        return view('people.index');
    }

    public function create(){
        return view('people.create');
    }

    public function store(Request $request){
        
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

        //envia dados para tabela locations
        $location = new Location();
        $location->city = $request->get('city');
        $location->state = $request->get('state');
        $location->save();

        //chaves estrangeiras
        $personContactLocation = new People_Contact_Location();
        $personContactLocation->people_id = $people->id;
        $personContactLocation->locations_id = $location->id;
        $personContactLocation->contacts_id = $contact->id;
        $personContactLocation->save();
        

        return redirect()->route('people.show');

    }

    public function show(){
        return view('people.show');
    }
}
