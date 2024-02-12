<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localizacao extends Model
{
    use HasFactory;
    protected $table = 'localizacao';

    public function desaparecidoLugar(){
        return $this->hasMany(DesaparecidoLugar::class);
    }

    public function desaparecidoContato(){
        return $this->hasMany(DesaparecidoContato::class);
    }

    public function naoIdentificaoLugar(){
        return $this->hasMany(NaoIdentificadoLugar::class);
    }

    public function naoIdentificadoContato(){
        return $this->hasMany(NaoIdentificadoContato::class);
    }
}
