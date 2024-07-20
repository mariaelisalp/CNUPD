<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    protected $fillable = [
        'id',
        'state_id',
        'station_id',
        'name',
        'created_at',
        'updated_at'
    ];

    public function state() {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function people(){
        return $this->belongsToMany(People::class);
    }

    public function city_station(){
        return $this->hasOne(City_Station::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public static function cities($state_id){
        return $cities = City::where('state_id', $state_id)->pluck('name', 'id');
        
    }
}