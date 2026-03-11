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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete()
                ->index();

            // account_id – split to avoid the bug
            $table->foreignId('account_id');
            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->cascadeOnDelete();
            $table->index('account_id');

            // category_id – same safe pattern
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();
            $table->index('category_id');

            $table->uuid('transfer_group_id')->nullable()->index()
                ->comment('UUID to link related transactions in a transfer');

            $table->decimal('amount', 19, 4)
                ->comment('positive = income/credit, negative = expense/debit');

            // currency snapshot
            $table->char('currency', 3)
                ->comment('ISO 4217 currency code snapshot at time of transaction');

            $table->string('type', 20);     // income, expense, transfer

            $table->text('description')->nullable();

            $table->dateTime('transaction_date')->index();

            // ── Composite indexes for common access patterns ───────
            // Dashboard / timeline (most frequent query pattern)
            $table->index(['user_id', 'transaction_date'], 'idx_transactions_user_date');

            // Per-account history
            $table->index(['account_id', 'transaction_date'], 'idx_transactions_account_date');

            // Category-level reporting (can be extended with partial index later)
            // $table->index(['user_id', 'category_id', 'transaction_date']); // if needed

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
