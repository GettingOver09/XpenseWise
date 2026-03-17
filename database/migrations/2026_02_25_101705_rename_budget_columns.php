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
        Schema::table('budgets', function (Blueprint $table) {
            $table->renameColumn('amount', 'limit_amount');
            $table->renameColumn('budget_month', 'month');

            $table->unique(['user_id', 'category_id', 'month']);

            $table->index('user_id');
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('budgets', function (Blueprint $table) {
            $table->renameColumn('limit_amount', 'amount');
            $table->renameColumn('month', 'budget_month');

            $table->dropIndex(['user_id']);
            $table->dropIndex(['category_id']);
        });
    }
};
