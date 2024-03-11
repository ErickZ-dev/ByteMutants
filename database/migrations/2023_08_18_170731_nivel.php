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
        Schema::create('tnivel', function (Blueprint $table) {
            $table->id();
            $table->string('area');
            $table->string('apariencia');
            $table->string('recompensa');

            $table->unsignedBigInteger('idNivDere')->nullable();
            $table->unsignedBigInteger('idNivIzqu')->nullable();
            $table->unsignedBigInteger('idNivArri')->nullable();
            $table->unsignedBigInteger('idNivAbaj')->nullable();
            $table->foreign('idNivDere')->references('id')->on('tnivel');
            $table->foreign('idNivIzqu')->references('id')->on('tnivel');
            $table->foreign('idNivArri')->references('id')->on('tnivel');
            $table->foreign('idNivAbaj')->references('id')->on('tnivel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tnivel');
    }
};
