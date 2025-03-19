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
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('age');
            $table->string('name');
            $table->string('area');
            $table->date('date_register');
            $table->foreignId('distrito_id')->constrained('distritos');
            $table->foreignId('gerente_id')->constrained('gerentes');
            $table->foreignId('condicion_id')->constrained('condicions');
            $table->foreignId('sede_id')->constrained('sedes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitals');
    }
};
