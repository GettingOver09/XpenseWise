<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    // Define the table name (optional, Laravel assumes it's the plural of the model name)
    protected $table = 'categories';

    // Define fillable fields for mass assignment
    protected $fillable = ['user_id', 'name'];

    // Relationship: A category belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: A category has many expenses
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    // Relationship: A category has many budgets
    public function budgets(): HasMany
    {
        return $this->hasMany(Budget::class);
    }
}
