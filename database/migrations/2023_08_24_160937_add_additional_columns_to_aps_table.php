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
        Schema::table('aps', function (Blueprint $table) {
            $table->string('ssid')->nullable();
            $table->string('adresse_ap', 15)->nullable();
            $table->string('masque', 15)->nullable();
            $table->integer('azimuth')->nullable();
            $table->integer('hauteur')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aps', function (Blueprint $table) {
            //
        });
    }
};
