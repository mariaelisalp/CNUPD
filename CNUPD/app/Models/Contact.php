<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public function peopleContactCity(){
        return $this->belongsTo(PeopleContactCity::class);
    }

    protected $fillable = [
        'name_organization',
        'email',
        'number'
    ];

}
