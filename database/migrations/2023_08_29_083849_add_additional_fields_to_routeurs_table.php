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
        Schema::table('routeurs', function (Blueprint $table) {
            $table->string('passerelle_routeur', 15);
            $table->string('masque_routeur', 15);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('routeurs', function (Blueprint $table) {
            //
        });
    }
};
