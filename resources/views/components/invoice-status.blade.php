@switch ( $invoice->status )
    @case( \App\Models\Invoice::STATUS_UNPAID )
        @if ( $invoice->duedate < $today )
            <span class="badge bg-red text-uppercase">Overdue</span>
        @else
            <span class="badge bg-yellow text-uppercase">Unpaid</span>
        @endif
        @break

    @case( \App\Models\Invoice::STATUS_PARTIALLY_PAID )
        @if ( $invoice->duedate < $today )
            <span class="badge bg-red text-uppercase">Overdue</span>
        @else
            <span class="badge bg-indigo text-uppercase">Part Paid</span>
        @endif
        @break

    @case( \App\Models\Invoice::STATUS_PAID )
        <span class="badge bg-green text-uppercase">Paid</span>
        @break

    @case( \App\Models\Invoice::STATUS_REFUNDED )
        <span class="badge bg-purple text-uppercase">Refunded</span>
        @break

    @case( \App\Models\Invoice::STATUS_CANCELLED )
        <span class="badge bg-dark text-uppercase">Cancelled</span>
        @break
@endswitch
