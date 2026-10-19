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
        Schema::create('portafolios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo');
            $table->string('profesion');
            $table->text('biografia');
            $table->string('ubicacion');
            $table->json('habilidades'); 
            $table->string('github_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('foto_perfil')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portafolios');
    }
};
