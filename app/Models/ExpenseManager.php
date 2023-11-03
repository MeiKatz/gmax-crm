<?php

namespace App\Models;

use App\Casts\Money;
use App\Models\Concerns\HasCurrencyAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpenseManager extends Model
{
    use HasFactory;
    use HasCurrencyAttribute;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amount' => Money::class,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project(): BelongsTo {
        return $this->belongsTo(
            Project::class
        );
    }
}
