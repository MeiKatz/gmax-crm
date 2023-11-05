<?php

namespace App\Models;

use App\Casts\Money;
use App\Models\Concerns\HasCurrencyAttribute;
use App\Models\Concerns\SerializesMoney;
use App\Models\Contracts\HasCurrency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpenseManager extends Model implements HasCurrency
{
    use HasFactory;
    use HasCurrencyAttribute;
    use SerializesMoney;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amount' => Money::class,
    ];

    /**
     * @return array
     */
    public function toArray() {
        return $this->serializeMoneyInArray(
            parent::toArray()
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project(): BelongsTo {
        return $this->belongsTo(
            Project::class
        );
    }
}
