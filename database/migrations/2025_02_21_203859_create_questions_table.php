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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->foreignIdFor(\App\Models\stories::class)->constrained()->onDelete('cascade');
            $table->string('correct_answer');
            $table->string('answer1');
            $table->string('answer2');
            $table->string('answer3');
            $table->timestamps();
        });
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Models\stories::class)->constrained()->onDelete('cascade');
            $table->bigInteger('score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
