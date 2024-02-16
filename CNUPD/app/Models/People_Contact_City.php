<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People_Contact_Location extends Model
{
    use HasFactory;
    protected $table = 'people_contacts_locations';

    public function people(){
        return $this->belongsTo(People::class, 'people_id');
    }

    public function contact(){
        return $this->belongsTo(Contact::class, 'contacts_id');
    }

    public function location(){
        return $this->belongsTo(City::class,'city_id');
    }
}
