<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        // Use chunk to process 500 records at a time
        DB::table('expenses')->orderBy('id')->chunk(500, function ($expenses) {
            foreach ($expenses as $expense) {
                // Find the oldest account for this user as a fallback
                $defaultAccountId = DB::table('accounts')
                    ->where('user_id', $expense->user_id)
                    ->orderBy('id')
                    ->value('id');

                // Skip migration if the user has no accounts to link to
                if (!$defaultAccountId) {
                    continue;
                }

                // Build a clean description from old data
                $description = trim(($expense->description ?? '') . ($expense->merchant ? " — {$expense->merchant}" : ''));

                DB::table('transactions')->insert([
                    'user_id'          => $expense->user_id,
                    'account_id'       => $defaultAccountId,
                    'category_id'      => $expense->category_id,
                    'amount'           => -abs($expense->amount), // Force negative for the ledger
                    'type'             => 'expense',
                    'description'      => $description ?: null,
                    'transaction_date' => $expense->expense_date . ' 12:00:00',
                    'status'           => 'cleared',
                    'created_at'       => $expense->created_at,
                    'updated_at'       => $expense->updated_at,
                ]);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Optional: you could delete the migrated rows, but usually not done
            // DB::table('transactions')->where('type', 'expense')->delete();
        });
    }
};
