<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localizacao extends Model
{
    use HasFactory;
    protected $table = 'locations';

    public function people_contacts_locations(){
        return $this->hasMany(People_Contact_Location::class);
    }

    protected $fillable = [
        'city',
        'state'
    ];

    
}
