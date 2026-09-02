<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->nullable();
            $table->enum('chamber', ['lower_house', 'senate']);
            $table->string('name');
            $table->timestamps();

            $table->unique(['name', 'chamber']);
        });

        Schema::create('bill_topic', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_id')->constrained()->cascadeOnDelete();
            $table->foreignId('topic_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('relevance')->nullable();
            $table->timestamps();

            $table->unique(['bill_id', 'topic_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('topics');
        Schema::dropIfExists('bill_topic');
    }
};