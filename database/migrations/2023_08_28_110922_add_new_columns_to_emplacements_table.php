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
        Schema::table('emplacements', function (Blueprint $table) {
            $table->float('local_latitude', 12, 10);
            $table->float('local_longitude', 12, 10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emplacements', function (Blueprint $table) {
            //
        });
    }
};
