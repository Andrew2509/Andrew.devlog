<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('joki_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('joki_service_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('desc')->nullable();
            $table->json('features');
            $table->string('price');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('joki_packages');
    }
};
