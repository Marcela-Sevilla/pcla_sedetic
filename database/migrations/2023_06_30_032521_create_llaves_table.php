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
        Schema::create('llaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ambiente_id')
            ->constrained('ambientes')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('estado',250);
            $table->string('ubicacion',300);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('llaves');
    }
};
