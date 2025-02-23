<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    // Define the table name (optional)
    protected $table = 'expenses';

    // Define fillable fields for mass assignment
    protected $fillable = ['user_id', 'category_id', 'merchant', 'amount', 'description', 'expense_date'];

    // Relationship: An expense belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: An expense belongs to a category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
