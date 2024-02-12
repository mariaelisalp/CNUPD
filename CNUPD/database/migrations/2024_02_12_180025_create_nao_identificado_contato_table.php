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
        Schema::create('nao_identificado_contato', function (Blueprint $table) {
            $table->id();
            $table->foreignId('NaoIdentificado_id')->constrained('nao_identificados', 'idNaoIdentificado');
            $table->foreignId('contato_id')->constrained('contatos', 'idContact');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nao_identificado_contato');
    }
};
