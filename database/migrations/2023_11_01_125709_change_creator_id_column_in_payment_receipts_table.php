<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCreatorIdColumnInPaymentReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_receipts', function (Blueprint $table) {
            $table
                ->unsignedInteger('creator_id')
                ->nullable(false)
                ->change();
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
            $table
                ->text('creator_id')
                ->nullable(true)
                ->change();
        });
    }
}
