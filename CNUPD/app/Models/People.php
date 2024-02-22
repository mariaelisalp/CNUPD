<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    public function people_contacts_city(){
        return $this->hasOne(People_Contact_City::class);
    }

    protected $fillable = [
        'name',
        'eye_color',
        'skin_color',
        'gender',
        'weight',
        'birth_date',
        'missing',
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

}  
