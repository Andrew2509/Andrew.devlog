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
        Schema::create('templates', function (Blueprint $col) {
            $col->id();
            $col->string('name');
            $col->string('type'); // banner, notification, page, other
            $col->string('content_type'); // text, html, link
            $col->text('content')->nullable();
            $col->boolean('status')->default(true);
            $col->boolean('is_new_tab')->default(false);
            $col->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
