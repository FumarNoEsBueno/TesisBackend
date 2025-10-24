<?php
// app/Http/Controllers/TicketController.php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $ticket = Ticket::with(['user', 'estado'])->get();
        return response()->json(['data' => $ticket]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mensaje' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'estado_id' => 'required|exists:estado,id',
        ]);

        $ticket = Ticket::create($validated);

        return response()->json([
            'message' => 'Ticket creado exitosamente',
            'data' => $ticket
        ], 201);
    }
}