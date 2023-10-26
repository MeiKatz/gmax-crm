@switch ( $status )
    @case(1)
        <span class="badge btn-white">Not Started</span>
        @break

    @case(2)
        <span class="badge bg-blue">In Progress</span>
        @break

    @case(3)
        <span class="badge bg-purple">In Review</span>
        @break

    @case(4)
        <span class="badge bg-yellow">On Hold</span>
        @break

    @case(5)
        <span class="badge bg-green">Completed</span>
        @break

    @case(6)
        <span class="badge bg-dark">Cancelled</span>
        @break
@endswitch
