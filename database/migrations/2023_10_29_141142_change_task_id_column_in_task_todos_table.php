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
        Schema::table('task_todos', function (Blueprint $table) {
            $table
                ->unsignedInteger('task_id')
                ->nullable(false)
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('task_todos', function (Blueprint $table) {
            $table
                ->text('task_id')
                ->nullable(true)
                ->change();
        });
    }
};
