<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectProjectStatus extends Component
{
    /**
     * @var \App\Models\Project
     */
    private $project;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $project )
    {
        $this->project = $project;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-project-status', [
            'status' => $this->project->status,
        ]);
    }
}
