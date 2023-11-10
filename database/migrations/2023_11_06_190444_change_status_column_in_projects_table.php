<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $mapping = [
        1 => 'not started',
        2 => 'in progress',
        3 => 'in review',
        4 => 'on hold',
        5 => 'completed',
        6 => 'cancelled',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::transaction(function () {
            Schema::table('projects', function (Blueprint $table) {
                $table
                    ->enum('status_enum', [
                        'not started',
                        'in progress',
                        'in review',
                        'on hold',
                        'completed',
                        'cancelled',
                    ])
                    ->default('not started');
            });

            foreach ( $this->mapping as $number => $enum ) {
                DB::table('projects')
                    ->where('status', $number)
                    ->update([
                        'status_enum' => $enum,
                    ]);
            }

            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('status');
            });

            Schema::table('projects', function (Blueprint $table) {
                $table->renameColumn(
                    'status_enum',
                    'status'
                );
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::transaction(function () {
            Schema::table('projects', function (Blueprint $table) {
                $table->renameColumn(
                    'status',
                    'status_enum'
                );
            });

            Schema::table('projects', function (Blueprint $table) {
                $table
                    ->unsignedSmallInteger('status')
                    ->default(1);
            });

            foreach ( $this->mapping as $number => $enum ) {
                DB::table('projects')
                    ->where('status_enum', $enum)
                    ->update([
                        'status' => $number,
                    ]);
            }

            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('status_enum');
            });
        });
    }
};
