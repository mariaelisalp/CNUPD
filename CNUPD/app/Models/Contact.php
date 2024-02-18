<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public function people_contact_city(){
        return $this->belongsTo(People_Contact_City::class, 'contacts_id');
    }

    protected $fillable = [
        'name_organization',
        'email',
        'number'
    ];

}
