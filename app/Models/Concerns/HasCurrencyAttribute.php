<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Money\Currency as MoneyCurrency;

trait HasCurrencyAttribute {
  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function currency(): Attribute {
    return Attribute::get(
      fn () => (
        $this->getCurrency()
      )
    );
  }

  /**
   * @return \Money\Currency
   */
  public function getCurrency(): MoneyCurrency {
    $attributes = $this->getAttributes();

    return new MoneyCurrency(
      $attributes['currency_code'] ?: 'XXX'
    );
  }
}
