<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('web_preinscripcion', function (Blueprint $table) {
            $table->json('campos_extra')->nullable()->after('detalle_docente');
        });
    }

    public function down(): void
    {
        Schema::table('web_preinscripcion', function (Blueprint $table) {
            $table->dropColumn('campos_extra');
        });
    }
};
