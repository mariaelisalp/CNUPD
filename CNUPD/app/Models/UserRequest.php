<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserRequest extends Model
{
    use HasFactory;
    use Notifiable;

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
