<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('fee_id');
            $table->unsignedBigInteger('request_id')->nullable();
            $table->timestamp('payment_date')->useCurrent();
            $table->decimal('amount_paid', 10, 2);
            $table->string('reference_number', 50)->unique();
            $table->enum('status', ['completado', 'rechazado', 'pendiente'])->default('pendiente');

            $table->foreign('fee_id')->references('fee_id')->on('fee_rates')->onDelete('cascade');
            $table->foreign('request_id')->references('request_id')->on('requests')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
