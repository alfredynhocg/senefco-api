<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('web_preinscripcion', function (Blueprint $table) {

            // --- Datos personales ---
            // El campo "nombre" original se renombra conceptualmente a nombres (se mantiene
            // para compatibilidad). Se agregan los apellidos por separado.
            $table->string('apellido_paterno', 100)->nullable()->after('nombre');
            $table->string('apellido_materno', 100)->nullable()->after('apellido_paterno');

            // Carnet de Identidad
            $table->string('ci', 30)->nullable()->after('apellido_materno');

            // Expedido (departamento donde fue expedido el CI) → FK a web_expedido
            $table->unsignedBigInteger('expedido_id')->nullable()->after('ci');
            $table->index('expedido_id');

            // Grado Académico → FK a web_grado_academico
            // (aparece antes del nombre en el certificado)
            $table->unsignedBigInteger('grado_academico_id')->nullable()->after('expedido_id');
            $table->index('grado_academico_id');

            // Certificado o título académico (ruta del archivo subido)
            $table->string('archivo_titulo', 255)->nullable()->after('grado_academico_id')
                ->comment('Ruta del certificado/título subido. Requerido según grado académico.');

            // --- Entrega del certificado físico ---
            // La columna "ciudad" ya existe; se usa como ciudad de residencia para entrega.
            // Se agrega provincia como campo complementario.
            $table->string('provincia', 120)->nullable()->after('ciudad')
                ->comment('Provincia de residencia si no está en capital, para envío del certificado físico.');

            // --- Pago ---
            $table->string('medio_pago', 100)->nullable()->after('provincia')
                ->comment('Medio por el cual realizó el pago (transferencia, depósito, QR, etc.)');
            $table->decimal('monto_pagado', 10, 2)->nullable()->after('medio_pago')
                ->comment('Monto pagado por el participante.');

            // --- Contacto WhatsApp ---
            // "telefono" ya existe; se usa para el celular del grupo de INSCRITOS.
            // Se renombra semánticamente en la UI; en BD se mantiene el campo original.

            // --- Documentos de identidad ---
            $table->string('archivo_ci_anverso', 255)->nullable()->after('monto_pagado')
                ->comment('Ruta de la foto/escaneo del carnet de identidad (anverso).');
            $table->string('archivo_ci_reverso', 255)->nullable()->after('archivo_ci_anverso')
                ->comment('Ruta de la foto/escaneo del carnet de identidad (reverso).');

            // --- Sugerencias ---
            $table->text('sugerencia_curso')->nullable()->after('archivo_ci_reverso')
                ->comment('Cursos de interés sugeridos por el participante.');

            $table->boolean('recomendar_docente')->default(false)->after('sugerencia_curso')
                ->comment('Indica si el participante desea recomendar un docente.');
            $table->text('detalle_docente')->nullable()->after('recomendar_docente')
                ->comment('Nombre, especialidad y contacto del docente recomendado (si aplica).');
        });
    }

    public function down(): void
    {
        Schema::table('web_preinscripcion', function (Blueprint $table) {
            $table->dropIndex(['expedido_id']);
            $table->dropIndex(['grado_academico_id']);
            $table->dropColumn([
                'apellido_paterno',
                'apellido_materno',
                'ci',
                'expedido_id',
                'grado_academico_id',
                'archivo_titulo',
                'provincia',
                'medio_pago',
                'monto_pagado',
                'archivo_ci_anverso',
                'archivo_ci_reverso',
                'sugerencia_curso',
                'recomendar_docente',
                'detalle_docente',
            ]);
        });
    }
};
