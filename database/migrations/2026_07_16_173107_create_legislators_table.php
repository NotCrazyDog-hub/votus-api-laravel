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
        Schema::create('legislators', function (Blueprint $table) {
            $table->id();
            $table->unique(['external_id', 'chamber']);
            $table->string('civil_name')->nullable();
            $table->string('parliamentary_name');
            $table->string('photo_url')->nullable();
            $table->string('party')->nullable();
            $table->string('state', 2)->nullable();
            $table->integer('legislature')->nullable();
            $table->string('status')->nullable();
            $table->string('electoral_status')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('official_website')->nullable();
            $table->json('social_media')->nullable();
            $table->json('raw_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legislators');
    }
};
