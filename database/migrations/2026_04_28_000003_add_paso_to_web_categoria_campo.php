<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('web_categoria_campo', function (Blueprint $table) {
            $table->tinyInteger('paso')->default(2)->after('orden')
                ->comment('1 = datos personales, 2 = documentos y datos adicionales');
        });
    }

    public function down(): void
    {
        Schema::table('web_categoria_campo', function (Blueprint $table) {
            $table->dropColumn('paso');
        });
    }
};
