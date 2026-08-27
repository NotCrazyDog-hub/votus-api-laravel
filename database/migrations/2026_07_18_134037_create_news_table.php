<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('original_summary')->nullable();
            $table->text('ai_summary');
            $table->string('url')->unique();
            $table->string('source')->default('Agência Brasil');
            $table->string('category')->nullable();
            $table->timestamp('published_at');
            $table->timestamp('imported_at')->useCurrent();
            $table->unsignedTinyInteger('relevance_score');
            $table->json('keywords');
            $table->boolean('published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('noticias');
    }
};