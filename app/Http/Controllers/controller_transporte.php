<?php
//controller_transporte.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transporte; 

class controller_transporte extends Controller
{

    //solicitarTransporte ingresa una solicitud de transporte
    // y retorna un JSON avisando que se ha registrado
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
        $transporte = Transporte::create($validated);

        // Respuesta exitosa
        return response()->json([
            'message' => 'Solicitud registrada con éxito',
            'data' => $transporte
        ], 201);
    }

    // Da un poco igual lo que ingreses
    // Retorna un JSON con todas las solicitudes de transporte
    public function getAllTransportes(Request $request) 
    {
        \Log::info("getAllTransportes ejecutado"); // Log para debug

        // Obtener todos los registros de transporte
        $transportes = Transporte::all();

        // Respuesta exitosa
        return response()->json([
            'message' => 'Lista de solicitudes de transportes',
            'data' => $transportes
        ], 200);
    }

   // update actualiza una solicitud de transporte
    // y retorna un JSON con la solicitud actualizada
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'transporte_desde'      => 'required|string',
            'transporte_hacia'      => 'required|string',
            'transporte_cuando'     => 'required|string',
            'transporte_hora'       => 'nullable|string',
            'transporte_descripcion'=> 'nullable|string',
        ]);

        $transporte = Transporte::findOrFail($id);
        $transporte->update($validated);

        return response()->json([
            'message' => 'Transporte actualizado',
            'data'    => $transporte
        ], 200);
    }

}
