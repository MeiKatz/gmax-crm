<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Money\Money as MoneyMoney;
use Money\Currencies as MoneyCurrencies;

class InputMoney extends Component
{
    /**
     * @var \Money\Money
     */
    private MoneyMoney $money;

    /**
     * Create a new component instance.
     */
    public function __construct( MoneyMoney $money )
    {
        $this->money = $money;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $currency = $this->money->getCurrency();
        $subunit  = app( MoneyCurrencies::class )->subunitFor( $currency );

        return view('components.input-money', [
            'amount' => $this->money->getAmount(),
            'subunit' => $subunit,
            'pattern' => (
                $subunit === 0
                    ? '-?[0-9]*'
                    : sprintf(
                        '-?[0-9]*(\.[0-9]{,%u})?',
                        $subunit
                    )
            ),
            'currencyCode' => $currency->getCode(),
        ]);
    }
}
