<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'limit_amount',
        'spent_amount',
        'month',
        'period_start',
        'period_end',
    ];

    protected function casts(): array
    {
        return [
            'limit_amount' => 'decimal:2',
            'spent_amount' => 'decimal:2',
            'month'        => 'date',
            'period_start' => 'date',
            'period_end'   => 'date',
            'created_at'   => 'datetime',
            'updated_at'   => 'datetime',
        ];
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault();
    }
}
