<?php

namespace App\Models;

use App\Casts\Money;
use App\Models\Contracts\HasCurrency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentReceipt extends Model implements HasCurrency
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amount' => Money::class,
    ];

    protected static function booting() {
        self::creating(function ( $model ) {
            if ( empty( $model->creator_id ) ) {
                $model->creator_id = optional( auth()->user() )->id;
            }
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentGateway() {
        return $this->belongsTo(
            PaymentGateway::class
        );
    }
}
