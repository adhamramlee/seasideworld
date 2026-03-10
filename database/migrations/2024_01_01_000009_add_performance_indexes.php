<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->index('role');
            $table->index('is_active');
        });

        Schema::table('inquiries', function (Blueprint $table) {
            $table->index('status');
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->index('status');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->index('status');
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
            $table->dropIndex(['is_active']);
        });

        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });
    }
};
