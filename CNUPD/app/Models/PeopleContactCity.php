<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeopleContactCity extends Model
{
    use HasFactory;
    protected $table = 'people_contacts_cities';

    public function people(){
        return $this->belongsTo(People::class, 'people_id');
    }

    public function contact(){
        return $this->hasOne(Contact::class, 'contacts_id');
    }

    public function city(){
        return $this->hasOne(City::class,'city_id');
    }
}
