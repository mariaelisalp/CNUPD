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
        Schema::create('nao_identificados', function (Blueprint $table) {
            $table->id('idNaoIdentificado');
            $table->string('name', 100);
            $table->integer('estimatedAge');
            $table->string('eyeColor', 50);
            $table->string('skinColor', 50);
            $table->string('status', 50);
            $table->char('gender');
            $table->text('otherFeatures', 200);
            $table->text('description');
            $table->foreignid('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nao_identificados');
    }
};
