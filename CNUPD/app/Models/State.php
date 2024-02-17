<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'name',
        'abbr,'
    ];

    public function city(){
        return $this->hasMany(City::class);

    }


}
