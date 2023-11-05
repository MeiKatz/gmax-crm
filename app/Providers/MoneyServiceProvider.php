<?php

namespace App\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Money\Currencies;
use Money\MoneyFormatter;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;

class MoneyServiceProvider extends ServiceProvider {
  /**
   * Register services.
   */
  public function register(): void {
    $this->app->singleton(
      Currencies::class,
      ISOCurrencies::class
    );

    $this->app->singleton(
      MoneyFormatter::class,
      function (Application $app) {
        return new DecimalMoneyFormatter(
          $this->app->make( Currencies::class )
        );
      }
    );
  }
}
