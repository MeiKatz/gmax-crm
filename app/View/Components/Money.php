<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Money\Money as MoneyMoney;

class Money extends Component
{
    /**
     * @var \Money\Money
     */
    private MoneyMoney $money;

    /**
     * Create a new component instance.
     *
     * @param  \Money\Money  $money
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
        return view('components.money', [
            'money' => $this->money,
            'amount' => (int) $this->money->getAmount(),
            'currency' => $this->money->getCurrency(),
        ]);
    }
}
