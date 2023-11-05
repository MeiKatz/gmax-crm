<?php

namespace App\Models\Contracts;

use Money\Currency as MoneyCurrency;

interface HasCurrency {
  public function getCurrency(): MoneyCurrency;
}
