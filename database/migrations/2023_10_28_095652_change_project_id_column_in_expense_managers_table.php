<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeProjectIdColumnInExpenseManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expense_managers', function (Blueprint $table) {
            $table
                ->unsignedInteger('project_id')
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
        Schema::table('expense_managers', function (Blueprint $table) {
            $table
                ->text('project_id')
                ->nullable(true)
                ->change();
        });
    }
}
