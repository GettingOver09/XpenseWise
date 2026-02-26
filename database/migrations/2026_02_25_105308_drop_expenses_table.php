<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('expenses');
    }

    public function down(): void
    {
        // Minimal recreation – only if you really need rollback capability
        Schema::create('expenses', function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 19, 4);
            $table->text('description')->nullable();
            $table->date('expense_date');
            $table->text('merchant')->nullable();
            $table->timestamps();
        });
    }
};
