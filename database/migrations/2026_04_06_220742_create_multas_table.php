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
        Schema::create('multas', function (Blueprint $table) {
            $table->id();
        
            // El estudiante que recibe la multa
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        
            // El administrador que crea la multa
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->integer('monto');
            $table->string('descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multas');
    }
};
