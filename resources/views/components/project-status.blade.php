@switch ( $status )
    @case( \App\Models\Project::STATUS_NOT_STARTED )
        <span class="badge btn-white">Not Started</span>
        @break

    @case( \App\Models\Project::STATUS_IN_PROGRESS )
        <span class="badge bg-blue">In Progress</span>
        @break

    @case( \App\Models\Project::STATUS_IN_REVIEW )
        <span class="badge bg-purple">In Review</span>
        @break

    @case( \App\Model\Project::STATUS_ON_HOLD )
        <span class="badge bg-yellow">On Hold</span>
        @break

    @case( \App\Models\Project::STATUS_COMPLETED )
        <span class="badge bg-green">Completed</span>
        @break

    @case( \App\Models\Project::STATUS_CANCELLED )
        <span class="badge bg-dark">Cancelled</span>
        @break
@endswitch
