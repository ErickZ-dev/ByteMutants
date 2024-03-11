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
        Schema::create('tmonstruo', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('especie');
            $table->string('saludMax');
            $table->string('energiaMax');
            $table->string('cargaTurno');
            $table->string('apariencia');
            $table->string('nivel');
            $table->string('seleccion');
            $table->string('at1dano');
            $table->string('at1energia');
            $table->string('at1alcance');
            $table->string('at1casillas');
            $table->unsignedBigInteger('idUsuario')->nullable();
            $table->unsignedBigInteger('idNivel')->nullable();
            $table->foreign('idUsuario')->references('id')->on('tusuario');
            $table->foreign('idNivel')->references('id')->on('tnivel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmonstruo');
    }
};
