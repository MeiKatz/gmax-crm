@switch ( true )
    @case( $invoice->isOverdue() )
        <span class="badge bg-red text-uppercase">Overdue</span>
        @break

    @case( $invoice->isUnpaid() )
        <span class="badge bg-yellow text-uppercase">Unpaid</span>
        @break

    @case( $invoice->isPartiallyPaid() )
        <span class="badge bg-indigo text-uppercase">Part Paid</span>
        @break

    @case( $invoice->isPaid() )
        <span class="badge bg-green text-uppercase">Paid</span>
        @break

    @case( $invoice->isRefunded() )
        <span class="badge bg-purple text-uppercase">Refunded</span>
        @break

    @case( $invoice->isCancelled() )
        <span class="badge bg-dark text-uppercase">Cancelled</span>
        @break
@endswitch
