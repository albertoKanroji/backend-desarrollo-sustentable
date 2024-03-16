<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use Illuminate\Support\Facades\Validator;

class ActividadController extends Controller
{
    public function index()
    {
        try {
            $actividades = Actividad::all();
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Actividades listadas correctamente',
                'data' => $actividades
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al listar actividades: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usuario_id' => 'required|exists:users,id',
            'tipo_actividad' => 'required|string',
            'detalle' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status' => 422,
                'message' => 'Error de validación',
                'data' => $validator->errors()
            ], 422);
        }

        try {
            $actividad = Actividad::create($request->all());
            return response()->json([
                'success' => true,
                'status' => 201,
                'message' => 'Actividad creada correctamente',
                'data' => $actividad
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al crear actividad: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function show($id)
    {
        try {
            $actividad = Actividad::findOrFail($id);
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Actividad encontrada',
                'data' => $actividad
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 404,
                'message' => 'Actividad no encontrada',
                'data' => null
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'usuario_id' => 'required|exists:users,id',
            'tipo_actividad' => 'required|string',
            'detalle' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status' => 422,
                'message' => 'Error de validación',
                'data' => $validator->errors()
            ], 422);
        }

        try {
            $actividad = Actividad::findOrFail($id);
            $actividad->update($request->all());
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Actividad actualizada correctamente',
                'data' => $actividad
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al actualizar actividad: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $actividad = Actividad::findOrFail($id);
            $actividad->delete();
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Actividad eliminada correctamente',
                'data' => null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al eliminar actividad: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }
}
