<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Transaction;

class AccountBalanceService
{
    /**
     * Recalculate all running balances for an account.
     */
    public function recalculate(int $accountId): void
    {
        $account = Account::findOrFail($accountId);

        $runningBalance = $account->initial_balance;

        $transactions = Transaction::where('account_id', $accountId)
            ->orderBy('transaction_date')
            ->orderBy('id')
            ->get();

        foreach ($transactions as $transaction) {

            $runningBalance += $transaction->amount;

            $transaction->running_balance = $runningBalance;

            // Prevent the observer from firing again
            $transaction->saveQuietly();
        }

        // Keep the account in sync with the latest transaction
        $account->current_balance = $runningBalance;
        $account->saveQuietly();
    }
}
