<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
                $model->creator_id = auth()->user()->id;
            }
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoice(): BelongsTo {
        return $this->belongsTo(
            Invoice::class,
            'invoice_id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function totalAmountWithoutTaxes(): Attribute {
        return Attribute::get(
            fn ( $value, array $attributes ) => (
                $attributes['quantity'] * $attributes['amount_per_item']
            )
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function totalAmount(): Attribute {
        return Attribute::get(
            fn () => (
                $this->total_amount_without_taxes + $this->getTaxes()
            )
        );
    }

    /**
     * @return int
     */
    private function getTaxes(): int {
        if ( !$this->invoice->is_taxable ) {
            return 0;
        }

        return $this->getTaxInPercents() * $this->total_amount_without_taxes / 100;
    }

    /**
     * @return int
     */
    private function getTaxInPercents(): int {
        $settings = Setting::find(1);
        return $settings->taxpercent;
    }
}
