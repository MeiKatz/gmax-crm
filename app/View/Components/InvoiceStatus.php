<?php

namespace App\View\Components;

use App\Models\Invoice;
use Illuminate\View\Component;

class InvoiceStatus extends Component
{
    /**
     * @var \App\Models\Invoice
     */
    private $invoice;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $invoice )
    {
        $this->invoice = $invoice;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.invoice-status', [
            'invoice' => $this->invoice,
            'today' => date('Y-m-d'),
        ]);
    }
}
