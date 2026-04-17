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
        Schema::table('t_programa', function (Blueprint $table) {
            $table->string('url_whatsapp', 500)->nullable()->after('url_video');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_programa', function (Blueprint $table) {
            $table->dropColumn('url_whatsapp');
        });
    }
};
