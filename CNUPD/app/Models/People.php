<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Http\Requests\StorePeopleRequest;

class People extends Model
{
    use HasFactory;

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function log(){
        return $this->hasMany(Log::class);

    }

    protected $fillable = [
        'name',
        'eye_color',
        'skin_color',
        'gender',
        'weight',
        'birth_date',
        'missing',
        'city_id',
        'missing_time_date',
        'time_date',
        'age',
        'father_name',
        'mother_name',
        'height',
        'other_features',
        'circumstances',
        'motivations',
        'image'
    ];

    public function getMissing($search = null, $date = null, $perPage = 10){
        return $this->getPeopleQuery($search, $date, 1)->paginate($perPage)->withQueryString();
    }

    public function getNotIdentified($search = null, $date = null, $perPage = 10){
        return $this->getPeopleQuery($search, $date, 0)->paginate($perPage)->withQueryString();
    }

    public function getPeopleQuery($search, $date, $missing){
        $query = People::select('people.id', 'people.name', 'people.missing_time_date', 'people.age', 'people.gender', 'cities.name as city', 'states.abbr as state')
            ->join('cities', 'people.city_id', '=', 'cities.id')
            ->join('states', 'cities.state_id', '=', 'states.id')
            ->where('people.missing', '=', $missing);

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('people.name', 'like', '%' . $search . '%')
                    ->orWhere('cities.name', 'like', '%' . $search . '%')
                    ->orWhere('states.abbr', 'like', '%' . $search . '%')
                    ->orWhere('people.missing_time_date', 'like', '%' . $search . '%')
                    ->orWhere('people.age', '=', $search)
                    ->orWhere('people.gender', 'like', '%' . $search . '%');
            });
        }

        if ($date) {
            $query->where('people.missing_time_date', '=', \Carbon\Carbon::parse($date)->format('Y-m-d'));
        }

        return $query;
    }

    public static function uploadImage(StorePeopleRequest $request){
        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        }
         else {
            $fileNameToStore = 'noImage.jpg';
        }

        return $fileNameToStore;
    }

    public static function updateImage(StorePeopleRequest $request, People $people){
        if ($request->input('remove_image') == 1) {
            if ($people->image && $people->image != 'noImage.jpg') {
                Storage::delete('public/images/' . $people->image);
            }
        }
        if($request->hasFile('image')){
            return $people->uploadImage($request);
        }   
        
    }

    public static function getDetails(People $people){
        $city = $people->city;
        $contactInfo = null;
        $state = null;
        $currentAge = Carbon::parse($people->birth_date)->age;

        if ($city) {
            // Acessa o estado associado à cidade
            $state = $city->state;
            $contactInfo = $city->city_station->station; 
        }

        return compact('city', 'state', 'contactInfo', 'currentAge');
    }


}  
