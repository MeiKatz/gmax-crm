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
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('projectid')->nullable();
            $table->string('taskid')->nullable();
            $table->string('recorring')->nullable();
            $table->string('recorringtype')->nullable();
            $table->string('recorringnextdate')->nullable();
            $table->string('recorringcreated')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('projectid');
            $table->dropColumn('taskid');
            $table->dropColumn('recorring');
            $table->dropColumn('recorringtype');
            $table->dropColumn('recorringnextdate');
            $table->dropColumn('recorringcreated');
        });
    }
}
