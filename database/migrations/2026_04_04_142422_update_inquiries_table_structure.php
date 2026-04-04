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
            if (Schema::hasColumn('inquiries', 'project_detail') && !Schema::hasColumn('inquiries', 'message')) {
                $table->renameColumn('project_detail', 'message');
            }
            if (!Schema::hasColumn('inquiries', 'service_category_id')) {
                $table->foreignId('service_category_id')->nullable()->after('id')->constrained('service_categories')->onDelete('set null');
            }
            if (!Schema::hasColumn('inquiries', 'service_name')) {
                $table->string('service_name')->nullable()->after('service_category_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            if (Schema::hasColumn('inquiries', 'service_category_id')) {
                $table->dropForeign(['service_category_id']);
                $table->dropColumn(['service_category_id']);
            }
            if (Schema::hasColumn('inquiries', 'service_name')) {
                $table->dropColumn(['service_name']);
            }
            if (Schema::hasColumn('inquiries', 'message') && !Schema::hasColumn('inquiries', 'project_detail')) {
                $table->renameColumn('message', 'project_detail');
            }
        });
    }
};
