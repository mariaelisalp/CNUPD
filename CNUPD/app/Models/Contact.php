<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public function people_contacts_locations(){
        return $this->hasMany(People_Contact_Location::class);
    }

    protected $fillable = [
        'name_organization',
        'email',
        'number'
    ];

}
