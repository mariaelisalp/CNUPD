<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desaparecido extends Model
{
    use HasFactory;

    public function Location(){
        return $this->hasOne(Location::class);
    }

    public function Contato(){
        return $this->hasOne(Contato::class);
    }
}
