<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Inertia\Inertia;
use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Http\Requests\Transaction\UpdateTransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of transactions with filters.
     */
    public function index(Request $request)
    {
        $query = Transaction::with(['account', 'category'])
            ->where('user_id', $request->user()->id)
            ->orderBy('transaction_date', 'desc');

        // Search by payee or description
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('payee', 'ilike', "%{$search}%")
                    ->orWhere('description', 'ilike', "%{$search}%");
            });
        }

        // Filter by type
        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        // Filter by account
        if ($request->filled('account_id')) {
            $query->where('account_id', $request->account_id);
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Date range
        if ($request->filled('from')) {
            $query->whereDate('transaction_date', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('transaction_date', '<=', $request->to);
        }

        $transactions = $query->paginate(50);

        return Inertia::render('Transactions', [
            'transactions' => $transactions,
            'filters' => $request->only(['search', 'type', 'account_id', 'category_id', 'from', 'to']),
        ]);
    }

    /**
     * Store a newly created transaction.
     */
    public function store(StoreTransactionRequest $request)
    {
        $transaction = Transaction::create([
            ...$request->validated(),
            'user_id' => $request->user()->id,
        ]);

        return back()->with('success', 'Transaction created successfully.');
    }

    /**
     * Show the form for editing the specified transaction.
     */
    public function edit(Transaction $transaction)
    {
        // $this->authorize('update', $transaction);
        return Inertia::render('Transactions/Edit', [
            'transaction' => $transaction->load(['account', 'category']),
        ]);
    }

    /**
     * Update the specified transaction.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        // $this->authorize('update', $transaction);

        $transaction->update($request->validated());

        return back()->with('success', 'Transaction updated successfully.');
    }

    /**
     * Remove the specified transaction.
     */
    public function destroy(Transaction $transaction)
    {
        // $this->authorize('delete', $transaction);
        $transaction->delete();

        return back()->with('success', 'Transaction deleted successfully.');
    }
}
