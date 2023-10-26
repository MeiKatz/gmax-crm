<?php

namespace App\View\Components;

use App\Models\Client;
use Illuminate\View\Component;

class SelectClient extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-client', [
            'clients' => Client::all()
        ]);
    }
}
