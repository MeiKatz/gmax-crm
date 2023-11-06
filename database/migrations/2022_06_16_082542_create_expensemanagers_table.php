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
        Schema::create('expensemanagers', function (Blueprint $table) {
            $table->id();
            $table->string('prid')->nullable();
            $table->string('item')->nullable();
            $table->string('amount')->nullable();
            $table->string('date')->nullable();
            $table->string('bill')->nullable();
            $table->string('auth')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expensemanagers');
    }
};
