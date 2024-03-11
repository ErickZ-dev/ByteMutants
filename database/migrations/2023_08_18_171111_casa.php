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
        Schema::create('tcasa', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ubicacionX');
            $table->string('ubicacionY');
            $table->string('pisos');
            $table->string('tipo');
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
        Schema::dropIfExists('tcasa');
    }
};
