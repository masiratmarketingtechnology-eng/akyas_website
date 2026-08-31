<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->string('image_path')->nullable()->change();
            $table->string('pdf_path')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->string('image_path')->nullable(false)->change();
            $table->string('pdf_path')->nullable(false)->change();
        });
    }
};
