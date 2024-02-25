<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People_Contact_City extends Model
{
    use HasFactory;
    protected $table = 'people_contacts_cities';

    public function people(){
        return $this->belongsTo(People::class, 'people_id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }
}
