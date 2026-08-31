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
        Schema::table('certificates', function (Blueprint $table) {
            $table->string('file_path')->after('title');
            $table->string('file_type')->default('jpg')->after('file_path');
            $table->string('thumbnail_path')->nullable()->after('file_type');
            $table->integer('sort_order')->default(0)->after('thumbnail_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropColumn(['file_path', 'file_type', 'thumbnail_path', 'sort_order']);
        });
    }
};
