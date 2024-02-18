<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    public function peopleContactsCity(){
        return $this->hasOne(PeopleContactCity::class);
    }

    protected $fillable = [
        'name',
        'eye_color',
        'skin_color',
        'gender',
        'weight',
        'birth_date',
        'missing_time_date',
        'time_date',
        'age',
        'missing',
        'father_name',
        'mother_name',
        'height',
        'other_features',
        'circumstances',
        'motivations'
    ];

}  
