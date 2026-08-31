<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_enquiries', function (Blueprint $table) {
            $table->timestamp('read_at')->nullable()->after('message');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('is_featured');
        });
    }

    public function down(): void
    {
        Schema::table('contact_enquiries', function (Blueprint $table) {
            $table->dropColumn('read_at');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });
    }
};
