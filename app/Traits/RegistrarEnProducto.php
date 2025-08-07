<?php

namespace App\Traits;

trait RegistrarEnProducto
{
    protected static function bootRegistrarEnProducto()
    {
        static::created(function ($model) {
            self::registrarEnProducto($model);
        });

        static::updated(function ($model) {
            self::actualizarEnProducto($model);
        });
    }

    private static function registrarEnProducto($model)
    {
        $tipo = strtolower(class_basename($model));
        $descripcion = $model->nombre ?? $model->{$tipo.'_nombre'} ?? 'Sin descripción';
        
        \DB::table('producto')->insert([
            'tipo_objeto' => $tipo,
            'id_objeto' => $model->id,
            'descripcion' => $descripcion,
            'peso' => $model->peso ?? 0,
            'fecha' => now()->format('Y-m-d'),
            'hora' => now()->format('H:i:s'),
            'estado_id' => $model->estado_id ?? 1,
            'almacen_id' => $model->almacen_id ?? 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    private static function actualizarEnProducto($model)
    {
        $tipo = strtolower(class_basename($model));
        
        \DB::table('producto')
            ->where('tipo_objeto', $tipo)
            ->where('id_objeto', $model->id)
            ->update([
                'descripcion' => $model->nombre ?? $model->{$tipo.'_nombre'} ?? 'Sin descripción',
                'peso' => $model->peso ?? 0,
                'estado_id' => $model->estado_id ?? 1,
                'almacen_id' => $model->almacen_id ?? 1,
                'updated_at' => now()
            ]);
    }
}