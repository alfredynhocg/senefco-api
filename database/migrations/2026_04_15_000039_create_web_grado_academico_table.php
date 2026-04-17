<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('web_grado_academico', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 150);        // Ej: Licenciado/a, Doctor/a
            $table->string('abreviatura', 30);    // Ej: Lic., Dr., Mg., Ing.
            $table->boolean('requiere_titulo')->default(true); // si requiere cargar certificado/título
            $table->boolean('activo')->default(true);
            $table->unsignedInteger('orden')->default(0);
            $table->timestampTz('created_at')->nullable()->useCurrent();
            $table->timestampTz('updated_at')->nullable();

            $table->index('activo');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('web_grado_academico');
    }
};
