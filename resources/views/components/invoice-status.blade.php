@switch ( true )
    @case( $invoice->is_overdue )
        <span class="badge bg-red text-uppercase">Overdue</span>
        @break

    @case( $invoice->is_unpaid )
        <span class="badge bg-yellow text-uppercase">Unpaid</span>
        @break

    @case( $invoice->is_partially_paid )
        <span class="badge bg-indigo text-uppercase">Part Paid</span>
        @break

    @case( $invoice->is_paid )
        <span class="badge bg-green text-uppercase">Paid</span>
        @break

    @case( $invoice->is_refunded )
        <span class="badge bg-purple text-uppercase">Refunded</span>
        @break

    @case( $invoice->is_cancelled )
        <span class="badge bg-dark text-uppercase">Cancelled</span>
        @break
@endswitch
