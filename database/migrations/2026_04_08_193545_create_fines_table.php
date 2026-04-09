<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fines', function (Blueprint $table) {
            $table->id('fine_id');
            $table->unsignedBigInteger('assignment_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->text('reason');
            $table->enum('status', ['pendiente', 'pagada', 'anulada'])->default('pendiente');
            $table->timestamps();

            $table->foreign('assignment_id')->references('assignment_id')->on('assignments')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fines');
    }
};
