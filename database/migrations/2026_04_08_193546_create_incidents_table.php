<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id('incident_id');
            $table->unsignedBigInteger('locker_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('description');
            $table->timestamp('report_date')->useCurrent();
            $table->enum('status', ['abierto', 'en_proceso', 'resuelto', 'cerrado'])->default('abierto');
            $table->text('resolution')->nullable();

            $table->foreign('locker_id')->references('locker_id')->on('lockers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
