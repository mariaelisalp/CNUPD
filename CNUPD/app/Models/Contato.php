<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;
    public function desaparecidoLugar(){
        return $this->hasMany(DesaparecidoLugar::class);
    }

    public function desaparecidoContato(){
        return $this->hasMany(DesaparecidoContato::class);
    }
}
