<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public function city_station(){
        return $this->belongsToMany(City_Station::class);
    }

    protected $fillable = [
        'name_station',
        'email',
        'number'
    ];

}