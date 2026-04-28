<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('joki_services', function (Blueprint $col) {
            $col->string('slug')->unique()->after('title')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('joki_services', function (Blueprint $col) {
            $col->dropColumn('slug');
        });
    }
};
