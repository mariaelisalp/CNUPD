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
        Schema::create('people_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('people_id')->references('id')->on('people'); //ID DA PESSOA
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //ID DO USUÁRIO QUE REALIZOU A AÇÃO
            $table->string('action'); //tipo de ação CREATE, UPDATE, DELETE
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people_logs');
    }
};
