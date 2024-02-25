<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City_Station extends Model
{
    use HasFactory;
    protected $table = 'cities_stations';

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function station(){
        return $this->belongsTo(Station::class);
    }

   
}