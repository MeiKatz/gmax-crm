@switch ( $status )
    @case(1)
        <span class="badge bg-yellow">Pending</span>
        @break

    @case(2)
        <span class="badge bg-green">Approved</span>
        @break

    @case(3)
        <span class="badge bg-red">Rejected</span>
        @break

    @case(4)
        <span class="badge bg-dark">Cancelled</span>
        @break
@endswitch
