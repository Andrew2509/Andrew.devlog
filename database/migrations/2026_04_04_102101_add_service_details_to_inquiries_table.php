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
        Schema::table('inquiries', function (Blueprint $table) {
            $table->foreignId('service_category_id')->nullable()->constrained('service_categories')->onDelete('set null')->after('id');
            $table->string('service_name')->nullable()->after('service_category_id');
            $table->renameColumn('project_detail', 'message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropForeign(['service_category_id']);
            $table->dropColumn(['service_category_id', 'service_name']);
            $table->renameColumn('message', 'project_detail');
        });
    }
};
