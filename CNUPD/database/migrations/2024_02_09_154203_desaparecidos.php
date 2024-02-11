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
        Schema::create('desaparecidos', function (Blueprint $table) {
            $table->id('idDesaparecido');
            $table->string('name', 100);
            $table->string('eyeColor', 50);
            $table->string('skinColor', 50);
            $table->char('gender');
            $table->float('weight');
            $table->date('birthDate');
            $table->date('desappearingDate');
            $table->integer('age');
            $table->string('status', 50);
            $table->string('fatherName', 50);
            $table->string('motherName',50);
            $table->float('height');
            $table->text('otherFeatures', 200);
            $table->text('circumstances', 200);
            $table->text('motivations', 200);
            $table->foreignid('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desaparecidos');
    }
};
