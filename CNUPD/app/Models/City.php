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
        'name',
        'created_at',
        'updated_at'
    ];

    public function state() {

        return $this->belongsTo(State::class, 'state_id');

    }

    public function people_contact_city(){
        return this->belongsToMany(People_Contact_City::class);
    }
}
