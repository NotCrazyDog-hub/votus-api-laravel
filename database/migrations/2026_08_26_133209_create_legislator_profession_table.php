<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('professions', function (Blueprint $table) {
            $table->id();
            $table->string('normalized_name')->unique();
            $table->unsignedInteger('camara_code')->nullable()->unique();
            $table->timestamps();
        });

        Schema::create('legislator_profession', function (Blueprint $table) {
            $table->id();
            $table->foreignId('legislator_id')->constrained()->cascadeOnDelete();
            $table->foreignId('profession_id')->constrained()->cascadeOnDelete();
            $table->enum('source', ['senate', 'lower_house']);
            $table->string('original_name');
            $table->boolean('is_primary')->nullable();
            $table->date('registered_at')->nullable();
            $table->timestamps();

            $table->unique(['legislator_id', 'profession_id', 'source']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('professions');
        Schema::dropIfExists('legislator_profession');
    }
};