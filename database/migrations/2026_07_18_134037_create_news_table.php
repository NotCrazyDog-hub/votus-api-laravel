<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('resumo_original')->nullable();
            $table->text('resumo_ia');
            $table->string('url')->unique();
            $table->string('fonte')->default('Agência Brasil');
            $table->string('categoria')->nullable();
            $table->timestamp('data_publicacao');
            $table->timestamp('data_importacao')->useCurrent();
            $table->unsignedTinyInteger('score_relevancia');
            $table->json('palavras_chave');
            $table->boolean('publicar')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('noticias');
    }
};