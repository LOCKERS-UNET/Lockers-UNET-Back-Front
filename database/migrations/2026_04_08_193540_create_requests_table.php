<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id('request_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('building_id');
            $table->enum('status', ['pendiente', 'aprobada', 'rechazada', 'pagada'])->default('pendiente');
            $table->timestamp('request_date')->useCurrent();
            $table->timestamp('response_date')->nullable();
            $table->text('observations')->nullable();

            $table->foreign('building_id')->references('building_id')->on('buildings')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
