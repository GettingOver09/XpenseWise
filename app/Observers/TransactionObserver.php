<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Models\Budget;
use Illuminate\Support\Facades\DB;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        if ($transaction->type === 'transfer') return;

        DB::transaction(function () use ($transaction) {
            $budget = Budget::where('user_id', $transaction->user_id)
                ->where('category_id', $transaction->category_id)
                ->whereMonth('month', $transaction->transaction_date->month)
                ->first();

            if ($budget) {
                $budget->spent_amount += $transaction->amount;
                $budget->save();
            }
        });
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        if ($transaction->type === 'transfer') return;

        if ($transaction->isDirty('currency')) {
            throw new \Exception('Transaction currency cannot be changed.');
        }

        DB::transaction(function () use ($transaction) {
            $original = $transaction->getOriginal();

            // 1. Subtract from old budget if category or month changed
            if ($original['category_id'] && $original['amount']) {
                $oldBudget = Budget::where('user_id', $transaction->user_id)
                    ->where('category_id', $original['category_id'])
                    ->whereMonth('month', (new \DateTime($original['transaction_date']))->format('m'))
                    ->first();
                if ($oldBudget) {
                    $oldBudget->spent_amount -= $original['amount'];
                    $oldBudget->save();
                }
            }

            // 2. Add to new budget
            $newBudget = Budget::where('user_id', $transaction->user_id)
                ->where('category_id', $transaction->category_id)
                ->whereMonth('month', $transaction->transaction_date->month)
                ->first();
            if ($newBudget) {
                $newBudget->spent_amount += $transaction->amount;
                $newBudget->save();
            }
        });
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        if ($transaction->type === 'transfer') return;

        DB::transaction(function () use ($transaction) {
            $budget = Budget::where('user_id', $transaction->user_id)
                ->where('category_id', $transaction->category_id)
                ->whereMonth('month', $transaction->transaction_date->month)
                ->first();
            if ($budget) {
                $budget->spent_amount -= $transaction->amount;
                $budget->save();
            }
        });
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        //
    }
}
