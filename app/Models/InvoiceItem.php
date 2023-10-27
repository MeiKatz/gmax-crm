<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class InvoiceItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id',
        'quantity',
        'qtykey',
        'meta',
        'amount_per_item',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'invoice'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'total_amount',
        'total_amount_without_taxes',
    ];

    protected static function booting() {
        self::creating(function ( $model ) {
            if ( empty( $model->creator_id ) ) {
                $model->creator_id = Auth::id();
            }
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoice() {
        return $this->belongsTo(
            Invoice::class,
            'invoice_id'
        );
    }

    public function getTotalAmountWithoutTaxesAttribute() {
        return $this->quantity * $this->amount_per_item;
    }

    public function getTotalAmountAttribute() {
        $totalAmountWithoutTaxes = $this->total_amount_without_taxes;

        if ( !$this->invoice->is_taxable ) {
            return $totalAmountWithoutTaxes;
        }

        return $this->getTax() * $totalAmountWithoutTaxes / 100;
    }

    /**
     * @return int
     */
    private function getTax() {
        $settings = Setting::find(1);
        return $settings->taxpercent;
    }
}
