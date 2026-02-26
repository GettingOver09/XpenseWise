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
        Schema::table('categories', function (Blueprint $table) {
            $table->enum('type', ['income', 'expense'])->nullable()->after('name');

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete()
                ->index()
                ->after('user_id');

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropIndex(['parent_id']);
            $table->dropIndex(['user_id']);
            $table->dropColumn(['parent_id', 'type']);
        });
    }
};
