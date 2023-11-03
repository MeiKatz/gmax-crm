<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddPaymentGatewayIdColumnToPaymentReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::table('payment_receipts', function (Blueprint $table) {
                $table
                    ->foreignId('payment_gateway_id')
                    ->nullable(true);
            });

            $paymentGateways = (
                DB::table('payment_gateways')
                    ->pluck('id', 'gatewayname')
            );

            foreach ( $paymentGateways as $name => $id ) {
                DB::table('payment_receipts')
                    ->where('gateway', $name)
                    ->update([
                        'payment_gateway_id' => $id,
                    ]);
            }

            Schema::table('payment_receipts', function (Blueprint $table) {
                $table
                    ->foreignId('payment_gateway_id')
                    ->nullable(false)
                    ->change();
            });
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_receipts', function (Blueprint $table) {
            $table->dropColumn('payment_gateway_id');
        });
    }
}
