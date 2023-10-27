<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

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
     * @return void
     */
    public function cancel() {
        $this->markAsCancelled();
        $this->save();
    }

    /**
     * @return void
     */
    public function markAsUnpaid() {
        $this->invostatus = self::STATUS_UNPAID;
    }

    /**
     * @return void
     */
    public function markAsPartiallyPaid() {
        $this->invostatus = self::STATUS_PARTIALLY_PAID;
    }

    /**
     * @return void
     */
    public function markAsPaid() {
        $this->invostatus = self::STATUS_PAID;
    }

    /**
     * @return void
     */
    public function markAsRefunded() {
        $this->invostatus = self::STATUS_REFUNDED;
    }

    /**
     * @return void
     */
    public function markAsCancelled() {
        $this->invostatus = self::STATUS_CANCELLED;
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client() {
        return $this->belongsTo(
            Client::class,
            'userid',
            'id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project() {
        return $this->belongsTo(
            Project::class,
            'projectid',
            'id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items() {
        return $this->hasMany(
            InvoiceMeta::class,
            'invoiceid'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments() {
        return $this->hasMany(
            PaymentReceipt::class,
            'invoiceid'
        );
    }
}
