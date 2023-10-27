@switch ( true )
    @case( $project->is_not_started )
        <span class="badge btn-white">Not Started</span>
        @break

    @case( $project->is_in_progress )
        <span class="badge bg-blue">In Progress</span>
        @break

    @case( $project->is_in_review )
        <span class="badge bg-purple">In Review</span>
        @break

    @case( $project->is_on_hold )
        <span class="badge bg-yellow">On Hold</span>
        @break

    @case( $project->is_completed )
        <span class="badge bg-green">Completed</span>
        @break

    @case( $project->is_cancelled )
        <span class="badge bg-dark">Cancelled</span>
        @break
@endswitch
