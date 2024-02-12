<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desaparecido extends Model
{
    use HasFactory;

    public function desaparecidoLugar(){
        return $this->hasOne(DesaparecidoLugar::class);
    }

    public function desaparecidoContato(){
        return $this->hasOne(DesaparecidoContato::class);
    }
}
