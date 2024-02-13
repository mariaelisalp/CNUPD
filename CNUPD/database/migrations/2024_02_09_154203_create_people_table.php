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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('eye_color');
            $table->string('skin_color');
            $table->char('gender');
            $table->float('weight');
            $table->date('birth_date');
            $table->date('missing_time_date');
            $table->date('time_date');
            $table->integer('age');
            $table->boolean('missing');
            $table->string('father_name');
            $table->string('mother_name');
            $table->float('height');
            $table->string('other_features');
            $table->string('circumstances');
            $table->string('motivations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
