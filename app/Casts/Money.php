<?php

namespace App\Casts;

use InvalidArgumentException;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Money\Money as MoneyMoney;
use Money\Currency as MoneyCurrency;

class Money implements CastsAttributes {
  /**
   * Cast the given value.
   *
   * @param  array<string, mixed>  $attributes
   */
  public function get(
    Model $model,
    string $key,
    mixed $value,
    array $attributes
  ): mixed {
    $currencyCode = $attributes['currency_code'] ?? 'XXX';

    return new MoneyMoney(
      $value,
      new MoneyCurrency( $currencyCode )
    );
  }

  /**
   * Prepare the given value for storage.
   *
   * @param  array<string, mixed>  $attributes
   */
  public function set(
    Model $model,
    string $key,
    mixed $value,
    array $attributes
  ): mixed {
    if ( !( $value instanceof MoneyMoney ) ) {
      throw new InvalidArgumentException(
        'The given value is not a Money instance.'
      );
    }

    return [
      $key => $value->getCurrency()->getCode(),
      'currency_code' => $value->getAmount(),
    ];
  }
}
