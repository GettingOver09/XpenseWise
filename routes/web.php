<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/transactions', [TransactionController::class, 'index'])
        ->name('transactions');

    Route::get('/budgets', function () {
        return Inertia::render('Budgets');
    })->name('budgets');

    Route::get('/categories', function () {
        return Inertia::render('Categories');
    })->name('categories');

    Route::get('/accounts', function () {
        return Inertia::render('Accounts');
    })->name('accounts');

    Route::get('/settings', function () {
        return Inertia::render('Settings');
    })->name('settings');

    Route::get('/faq', function () {
        return Inertia::render('FAQ');
    })->name('faq');

    Route::get('/about', function () {
        return Inertia::render('About');
    })->name('about');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
