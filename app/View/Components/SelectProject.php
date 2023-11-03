<?php

namespace App\View\Components;

use App\Models\Project;
use Illuminate\View\Component;

class SelectProject extends Component
{
    /**
     * @var int
     */
    private $selected;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $selected = null )
    {
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-project', [
            'projects' => (
                Project::select(['name', 'id'])
                    ->orderBy('name')->get()
            ),
            'selected' => $this->selected,
        ]);
    }
}
