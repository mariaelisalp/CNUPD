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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('people_id')->nullable()->references('id')->on('people')->onDelete('cascade'); //ID DA PESSOA
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //ID DO USUÁRIO QUE REALIZOU A AÇÃO
            $table->unsignedBigInteger('target_user_id')->nullable();
            $table->enum('action',['CREATE', 'READ', 'UPDATE', 'DELETE', 'LOGIN', 'AUTHORIZE', 'ENABLE', 'DISABLE']); //tipo de ação 
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
