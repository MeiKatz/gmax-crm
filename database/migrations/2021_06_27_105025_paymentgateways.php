<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paymentgateways', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('gatewayname')->nullable();
            $table->text('icon')->nullable();
            $table->text('paytitle')->nullable();
            $table->text('apikey')->nullable();
            $table->text('apisecret')->nullable();
            $table->text('apiextra')->nullable();
            $table->text('apiextra2')->nullable();
            $table->text('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paymentgateways');
    }
}
