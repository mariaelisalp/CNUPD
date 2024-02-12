<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NaoIdentificado extends Model
{
    use HasFactory;

    public function naoIdentificaoLugar(){
        return $this->hasOne(NaoIdentificadoLugar::class);
    }

    public function naoIdentificadoContato(){
        return $this->hasOne(NaoIdentificadoContato::class);
    }

}
