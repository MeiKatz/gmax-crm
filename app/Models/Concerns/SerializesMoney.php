<?php

namespace App\Models\Concerns;

use Money\Money as MoneyMoney;

trait SerializesMoney {
  /**
   * @param  array  $array
   * @return array
   */
  protected function serializeMoneyInArray(
    array $array
  ): array {
    foreach ( $array as $key => $value ) {
      if ( !( $value instanceof MoneyMoney ) ) {
        continue;
      }

      $array[ $key ] = $this->serializeMoney( $value );
    }

    return $array;
  }

  /**
   * @param  \Money\Money  $money
   * @return array<string,int|string>
   */
  protected function serializeMoney(
    MoneyMoney $money
  ): array {
    $money = $money->jsonSerialize();

    return [
      'amount' => (int) $money['amount'],
      'currency' => $money['currency'],
    ];
  }
}
