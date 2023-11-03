<?php

namespace App\Models\Invoice\Concerns;

use App\Models\Concerns\HasCurrencyAttribute;
use App\Models\InvoiceItem;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Money\Money as MoneyMoney;

trait HasAttributes {
  use HasCurrencyAttribute;

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isTaxable(): Attribute {
    return Attribute::get(
      fn ( $value, array $attributes ) => (
        $attributes['taxable'] == 1
      )
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function totalAmount(): Attribute {
    return Attribute::get(
      fn () => (
        $this->items->reduce(function (
          MoneyMoney $carry,
          InvoiceItem $current
        ) {
          return $carry->add( $current->total_amount );
        }, new MoneyMoney(
          0,
          $this->getCurrency()
        ))
      )
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isUnpaid(): Attribute {
    return $this->newAttributeForStatus( self::STATUS_UNPAID );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isPartiallyPaid(): Attribute {
    return $this->newAttributeForStatus( self::STATUS_PARTIALLY_PAID );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isPaid(): Attribute {
    return $this->newAttributeForStatus( self::STATUS_PAID );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isRefunded(): Attribute {
    return $this->newAttributeForStatus( self::STATUS_REFUNDED );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isCancelled(): Attribute {
    return $this->newAttributeForStatus( self::STATUS_CANCELLED );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isOverdue(): Attribute {
    return Attribute::get(
      function ( $value, array $attributes ) {
        $today = date('Y-m-d');

        if ( $attributes['duedate'] >= $today ) {
          return false;
        }

        return (
          $this->is_unpaid
            || $this->is_partially_paid
        );
      }
    );
  }

  /**
   * !! Cannot define the return value because otherwise
   * Laravel will recognize this function as an attribute. !!
   *
   * @param  int  $status
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  private function newAttributeForStatus(
    int $status
  ) {
    return Attribute::get(
      fn ( $value, array $attributes ) => (
        $attributes['invostatus'] == $status
      )
    );
  }
}
