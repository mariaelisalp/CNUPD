<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People_Log extends Model
{
    use HasFactory;

    public function people(){
        return $this->hasOne(People::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }
}
