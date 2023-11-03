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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('prefix')->nullable();
            $table->string('suffix')->nullable();
            $table->string('taxstatus')->nullable();
            $table->string('taxname')->nullable();
            $table->string('taxpercent')->nullable();
            $table->string('invoicenote')->nullable();
            $table->string('quotenote')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('prefix');
            $table->dropColumn('suffix');
            $table->dropColumn('taxstatus');
            $table->dropColumn('taxname');
            $table->dropColumn('taxpercent');
            $table->dropColumn('invoicenote');
            $table->dropColumn('quotenote');
        });
    }
}
