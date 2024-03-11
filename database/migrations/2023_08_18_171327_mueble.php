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
        Schema::create('tmueble', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->string('ubicacionX');
            $table->string('ubicacionY');
            $table->unsignedBigInteger('idUsuario')->nullable();
            $table->foreign('idUsuario')->references('id')->on('tusuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmueble');
    }
};
