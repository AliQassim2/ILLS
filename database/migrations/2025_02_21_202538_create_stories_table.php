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
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->string('description');
            $table->string('title');
            $table->string('Author')->nullable();
            $table->tinyInteger('Difficulty')->default(1);
            $table->boolean('is_active')->default(true);
            $table->bigInteger('views')->default(0);
            $table->boolean('suggested')->default(false);
            $table->foreignIdFor(\App\Models\User::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('story_comments', function (Blueprint $table) {
            $table->id();
            $table->string('body');
            $table->foreignIdFor(\App\Models\stories::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Models\User::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('story_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\stories::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Models\User::class)->constrained()->onDelete('cascade');
            $table->tinyInteger('like');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories');
        Schema::dropIfExists('story_comments');
        Schema::dropIfExists('story_likes');
        Schema::dropIfExists('favorite');
    }
};
