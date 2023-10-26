<?php

namespace App\View\Components;

use App\Models\Invoice as Offer;
use Illuminate\View\Component;

class OfferStatus extends Component
{
    /**
     * @var \App\Models\Invoice
     */
    private $offer;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $offer )
    {
        $this->offer = $offer;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.offer-status', [
            'status' => $this->offer->quotestat,
        ]);
    }
}
