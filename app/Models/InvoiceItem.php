<?php

namespace App\Models;

use App\Casts\Money;
use App\Models\Concerns\HasCurrencyAttribute;
use App\Models\Contracts\HasCurrency;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Money\Money as MoneyMoney;

class InvoiceItem extends Model implements HasCurrency
{
    use HasFactory;
    use HasCurrencyAttribute;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amount_per_item' => Money::class,
    ];

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
                MoneyMoney::make(
                    $attributes['amount_per_item'],
                    $this->getCurrency()
                )->multiply( $attributes['quantity'] )
            )
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function totalAmount(): Attribute {
        return Attribute::get(
            fn () => (
                $this->total_amount_without_taxes->add( $this->getTaxes() )
            )
        );
    }

    /**
     * @return \Money\Money
     */
    private function getTaxes(): MoneyMoney {
        if ( !$this->invoice->is_taxable ) {
            return MoneyMoney::make(
                0,
                $this->getCurrency()
            );
        }

        return $this->total_amount_without_taxes->multiply(
            $this->getTaxInPercents() / 100
        );
    }

    /**
     * @return int
     */
    private function getTaxInPercents(): int {
        $settings = Setting::find(1);
        return $settings->taxpercent;
    }
}
