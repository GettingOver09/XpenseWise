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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete()
                ->index();

            $table->string('name', 100);
            $table->string('type', 30);           // cash, bank, credit, ewallet, investment, ...
            $table->string('icon', 8)->nullable();
            $table->string('currency', 3)->default('PHP');
            $table->decimal('initial_balance', 19, 4)->default(0);
            $table->decimal('current_balance', 19, 4)->default(0);

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
