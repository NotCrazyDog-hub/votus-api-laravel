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
        Schema::create('committees', function (Blueprint $table) {
            $table->id();
            $table->string('external_id');
            $table->enum('chamber', ['lower_house', 'senate']);
            $table->string('name');
            $table->string('acronym')->nullable();
            $table->timestamps();

            $table->unique(['external_id', 'chamber']);
        });

        Schema::create('committee_legislator', function (Blueprint $table) {
            $table->id();
            $table->foreignId('legislator_id')->constrained()->cascadeOnDelete();
            $table->foreignId('committee_id')->constrained()->cascadeOnDelete();
            $table->string('role')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('committees');
    }
};
