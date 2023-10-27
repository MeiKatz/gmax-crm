<?php

namespace App\Models;

use App\Models\Invoice\Concerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    use Concerns\HasActions;
    use Concerns\HasRelations;

    const STATUS_UNPAID    = 1;
    const STATUS_PARTIALLY_PAID = 2;
    const STATUS_PAID      = 3;
    const STATUS_REFUNDED  = 4;
    const STATUS_CANCELLED = 5;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'totalamount' => 0,
        'paidamount' => 0,
        'invostatus' => 1, // unpaid
    ];

    protected static function booting() {
        self::creating(function ( $model ) {
            $today = date('Y-m-d');

            if ( empty( $model->invodate ) ) {
                $model->invodate = $today;
            }

            if ( empty( $model->duedate ) ) {
                $model->duedate = $today;
            }
        });
    }

    /**
     * @return bool
     */
    public function isUnpaid() {
        return $this->invostatus === self::STATUS_UNPAID;
    }

    /**
     * @return bool
     */
    public function isPartiallyPaid() {
        return $this->invostatus === self::STATUS_PARTIALLY_PAID;
    }

    /**
     * @return bool
     */
    public function isPaid() {
        return $this->invostatus === self::STATUS_PAID;
    }

    /**
     * @return bool
     */
    public function isRefunded() {
        return $this->invostatus === self::STATUS_REFUNDED;
    }

    /**
     * @return bool
     */
    public function isCancelled() {
        return $this->invostatus === self::STATUS_CANCELLED;
    }

    /**
     * @return bool
     */
    public function isOverdue() {
        $today = date('Y-m-d');

        if ( $this->duedate >= $today ) {
            return false;
        }

        return ( $this->isUnpaid() || $this->isPartiallyPaid() );
    }
}
