<?php

namespace App\Application\Proyectos\DTOs;

final readonly class ProyectoDTO
{
    public function __construct(
        public int $id,
        public ?string $codigo_sipfe,
        public int $estado_id,
        public string $estado_nombre,
        public int $secretaria_id,
        public string $secretaria_nombre,
        public string $nombre,
        public string $slug,
        public ?string $descripcion,
        public float $presupuesto_total,
        public ?string $ubicacion_texto,
        public ?float $latitud,
        public ?float $longitud,
        public ?string $contratista,
        public ?string $fecha_inicio_estimada,
        public ?string $fecha_fin_estimada,
        public ?string $imagen_portada_url,
        public float $porcentaje_avance_fisico,
        public float $monto_ejecutado_financiero,
        public float $saldo_financiero,
        public bool $publico,
    ) {}

    public static function fromModel(object $model): self
    {
        $ultimo = $model->ultimoAvance;
        $ejecutado = $ultimo ? (float) $ultimo->monto_financiero_ejecutado : 0;
        $fisico = $ultimo ? (float) $ultimo->porcentaje_fisico : 0;

        return new self(
            id: (int) $model->id,
            codigo_sipfe: $model->codigo_sipfe,
            estado_id: (int) $model->estado_id,
            estado_nombre: $model->estado?->nombre ?? '',
            secretaria_id: (int) $model->secretaria_id,
            secretaria_nombre: $model->secretaria?->nombre ?? '',
            nombre: $model->nombre,
            slug: $model->slug,
            descripcion: $model->descripcion,
            presupuesto_total: (float) $model->presupuesto_total,
            ubicacion_texto: $model->ubicacion_texto,
            latitud: $model->latitud ? (float) $model->latitud : null,
            longitud: $model->longitud ? (float) $model->longitud : null,
            contratista: $model->contratista,
            fecha_inicio_estimada: $model->fecha_inicio_estimada?->toDateString(),
            fecha_fin_estimada: $model->fecha_fin_estimada?->toDateString(),
            imagen_portada_url: $model->imagen_portada_url,
            porcentaje_avance_fisico: (float) $fisico,
            monto_ejecutado_financiero: (float) $ejecutado,
            saldo_financiero: (float) ($model->presupuesto_total - $ejecutado),
            publico: (bool) $model->publico,
        );
    }
}
