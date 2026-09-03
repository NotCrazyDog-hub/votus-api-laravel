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
        Schema::create('bill_tramitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_id')->constrained()->cascadeOnDelete();
            $table->date('event_date')->nullable();   //dataHora / data
            $table->unsignedInteger('sequence')->nullable();
            $table->string('committee_code')->nullable();      // siglaOrgao / siglaLocal
            $table->string('action_description')->nullable();  // descricaoTramitacao / descricao
            $table->string('status_description')->nullable();  // descricaoSituacao
            $table->string('status_code')->nullable();          // codSituacao
            $table->text('dispatch_text')->nullable();          // despacho / descricao
            $table->timestamps();

            $table->index(['bill_id', 'event_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_tramitations');
    }
};
