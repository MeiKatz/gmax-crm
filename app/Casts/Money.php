<?php

namespace App\Casts;

use InvalidArgumentException;
use App\Models\Contracts\HasCurrency;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Money\Money as MoneyMoney;

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
    if ( !( $model instanceof HasCurrency ) ) {
      throw new InvalidArgumentException(
        sprintf(
          'The given model does not implement %s.',
          HasCurrency::class
        )
      );
    }

    return new MoneyMoney(
      $value,
      $model->getCurrency()
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
