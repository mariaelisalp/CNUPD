<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'email',
        'city_id',
        'password',
        'full_name',
        'position',
    ];
}
