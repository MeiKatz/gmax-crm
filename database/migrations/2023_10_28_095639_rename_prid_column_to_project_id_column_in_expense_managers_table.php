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
        Schema::table('expense_managers', function (Blueprint $table) {
            $table->renameColumn(
                'prid',
                'project_id'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expense_managers', function (Blueprint $table) {
            $table->renameColumn(
                'project_id',
                'prid'
            );
        });
    }
};
