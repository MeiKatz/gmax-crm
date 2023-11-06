<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
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
     */
    public function down(): void
    {
        Schema::table('payment_receipts', function (Blueprint $table) {
            $table->dropColumn('payment_gateway_id');
        });
    }
};
