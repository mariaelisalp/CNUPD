<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('localizacao', function (Blueprint $table) {
            $table->id('idLocalizacao');
            $table->string('city');
            $table->string('state');
            $table->foreignId('desaparecido_id')->constrained('desaparecidos', 'idDesaparecido');
            $table->foreignId('naoIdentificado_id')->constrained('nao_identificados', 'idNaoIdentificado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('localizacao');
    }
};
