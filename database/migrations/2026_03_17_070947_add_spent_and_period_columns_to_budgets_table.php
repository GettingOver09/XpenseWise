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
            // Track how much has been used
            $table->decimal('spent_amount', 15, 2)
                ->default(0)
                ->after('limit_amount');

            // Flexible period (instead of relying only on "month")
            $table->date('period_start')
                ->nullable()
                ->after('month');

            $table->date('period_end')
                ->nullable()
                ->after('period_start');

            // Optional: index for faster filtering
            $table->index(['user_id', 'period_start', 'period_end']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('budgets', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'period_start', 'period_end']);

            $table->dropColumn([
                'spent_amount',
                'period_start',
                'period_end',
            ]);
        });
    }
};
