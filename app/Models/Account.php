<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{

    use HasFactory;

    // ── Relationships ────────────────────────────────────────
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    // Optional: helper to get display name with balance
    public function getDisplayLabelAttribute(): string
    {
        return "{$this->name} ({$this->currency} {$this->current_balance})";
    }

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'icon',
        'currency',
        'initial_balance',
        'current_balance',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'initial_balance' => 'decimal:4',
            'current_balance' => 'decimal:4',
            'is_active' => 'boolean',
        ];
    }
}
