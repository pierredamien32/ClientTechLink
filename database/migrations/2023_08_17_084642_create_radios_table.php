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
        Schema::create('radios', function (Blueprint $table) {
            $table->id();
            $table->string('nom_radio');
            $table->string('adresse_radio', 15);
            $table->integer('signal');
            $table->string('passerelle', 15);
            $table->string('masque', 15);
            $table->foreignId('ap_id')->contrained()->onDelete('cascade');
            $table->foreignId('emplacement_id')->contrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('radios');
    }
};
