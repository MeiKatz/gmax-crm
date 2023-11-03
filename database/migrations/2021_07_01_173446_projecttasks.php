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
        Schema::create('projecttasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('prid')->nullable();
            $table->text('aid')->nullable();
            $table->text('task')->nullable();
            $table->text('assignedto')->nullable();
            $table->text('type')->nullable();
            $table->text('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projecttasks');
    }
}
