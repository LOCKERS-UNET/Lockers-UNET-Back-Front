<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lockers', function (Blueprint $table) {
            $table->id('locker_id');
            $table->unsignedBigInteger('sector_id');
            $table->string('locker_number', 20);
            $table->enum('status', ['disponible', 'ocupado', 'mantenimiento', 'inhabilitado'])->default('disponible');
            $table->text('observations')->nullable();
            $table->timestamps();

            $table->foreign('sector_id')->references('sector_id')->on('sectors')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lockers');
    }
};
