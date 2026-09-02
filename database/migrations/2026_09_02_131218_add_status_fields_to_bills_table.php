<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->string('status_situacao')->nullable()->after('raw_data');
            $table->string('status_sigla')->nullable()->after('status_situacao');
            $table->boolean('status_tramitando')->nullable()->after('status_sigla');
            $table->timestamp('status_checked_at')->nullable()->after('status_tramitando');
        });
    }

    public function down(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->dropColumn(['status_situacao', 'status_sigla', 'status_tramitando', 'status_checked_at']);
        });
    }
};