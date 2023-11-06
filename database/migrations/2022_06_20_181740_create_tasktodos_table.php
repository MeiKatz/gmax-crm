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
        Schema::create('tasktodos', function (Blueprint $table) {
            $table->id();
            $table->string('taskid')->nullable();
            $table->string('task')->nullable();
            $table->string('auth')->nullable();
            $table->string('completed')->nullable();
            $table->string('completedby')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasktodos');
    }
};
