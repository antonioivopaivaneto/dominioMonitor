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
        Schema::create('verificacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained('pages')->onDelete('cascade');
            $table->string('status');
            $table->text('detalhes')->nullable();
            $table->timestamp('verificado_em');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verificacoes');
    }
};
