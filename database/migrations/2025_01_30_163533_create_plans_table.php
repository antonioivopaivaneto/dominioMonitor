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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('max_domains')->default(2);
            $table->decimal('price',10,2)->default(0.00);
            $table->timestamps();
        });

        \DB::table('plans')->insert([
            ['name' => 'free','max_domains' => 2,'price'=> 0.00],
            ['name' => 'premium','max_domains' => 999,'price'=> 49.00]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
