<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\model_transporte; // Asegúrate de importar el modelo

class controller_transporte extends Controller
{
    public function solicitarTransporte(Request $request) 
    {
        \Log::info("solicitarTransporte ejecutado"); // Log para debug

        // Validación de datos
        $validated = $request->validate
        ([
            'transporte_solicitante' => 'nullable|string',
            'transporte_desde' => 'required|string',
            'transporte_hacia' => 'required|string',
            'transporte_cuando' => 'required|string',
            'transporte_hora' => 'nullable|string',
            'transporte_descripcion' => 'nullable|string',
        ]);

        // Guardar en base de datos
        $transporte = model_transporte::create($validated);

        // Respuesta exitosa
        return response()->json([
            'message' => 'Solicitud registrada con éxito',
            'data' => $transporte
        ], 201);
    }

    public function getAllTransportes(Request $request) 
    {
        \Log::info("getAllTransportes ejecutado"); // Log para debug

        // Obtener todos los registros de transporte
        $transportes = model_transporte::all();

        // Respuesta exitosa
        return response()->json([
            'message' => 'Lista de solicitudes de transportes',
            'data' => $transportes
        ], 200);
    }

   // public function getTransportesActivos
}
