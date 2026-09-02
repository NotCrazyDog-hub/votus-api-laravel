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
            $table->string('status_orgao')->nullable()->after('status_situacao');
            $table->timestamp('status_checked_at')->nullable()->after('status_orgao');
        });
    }

    public function down(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->dropColumn(['status_situacao', 'status_orgao', 'status_checked_at']);
        });
    }
};