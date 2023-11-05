<?php

use Money\Money;
use Money\MoneyFormatter;

if ( !function_exists('format_money') ) {
  function format_money( Money $money ): string {
    return app( MoneyFormatter::class )->format( $money );
  }
}
