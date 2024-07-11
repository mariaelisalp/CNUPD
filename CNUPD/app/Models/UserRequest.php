<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
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

    public function files(){
        return $this->hasMany(User_Files::class);
    }
}
