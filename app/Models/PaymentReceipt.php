<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentReceipt extends Model
{
    use HasFactory;

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
