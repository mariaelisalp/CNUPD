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
        Schema::create('_desaparecido_lugar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desaparecido_id')->constrained('desaparecidos', 'idDesaparecido');
            $table->foreignId('localizacao_id')->constrained('localizacao', 'idLocalizacao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_desaparecido_lugar');
    }
};
