<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
