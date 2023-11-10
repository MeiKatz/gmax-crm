<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $mapping = [
        1 => 'unpaid',
        2 => 'partially paid',
        3 => 'paid',
        4 => 'refunded',
        5 => 'cancelled',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table
                ->enum('status_enum', [
                    'unpaid',
                    'partially paid',
                    'paid',
                    'refunded',
                    'cancelled',
                ])
                ->default('unpaid');
        });

        foreach ( $this->mapping as $number => $enum ) {
            DB::table('invoices')
                ->where('invostatus', $number)
                ->update([
                    'status_enum' => $enum,
                ]);
        }

        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('invostatus');
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->renameColumn(
                'status_enum',
                'invostatus'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::transaction(function () {
            Schema::table('invoices', function (Blueprint $table) {
                $table->renameColumn(
                    'invostatus',
                    'status_enum'
                );
            });

            Schema::table('invoices', function (Blueprint $table) {
                $table
                    ->text('invostatus')
                    ->nullable();
            });

            foreach ( $this->mapping as $number => $enum ) {
                DB::table('invoices')
                    ->where('status_enum', $enum)
                    ->update([
                        'invostatus' => $number,
                    ]);
            }

            Schema::table('invoices', function (Blueprint $table) {
                $table->dropColumn('status_enum');
            });
        });
    }
};
