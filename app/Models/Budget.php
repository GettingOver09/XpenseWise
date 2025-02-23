<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Budget extends Model
{
    // Define the table name (optional)
    protected $table = 'budgets';

    // Define fillable fields for mass assignment
    protected $fillable = ['user_id', 'category_id', 'amount', 'budget_month'];

    // Relationship: A budget belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: A budget belongs to a category (optional)
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
