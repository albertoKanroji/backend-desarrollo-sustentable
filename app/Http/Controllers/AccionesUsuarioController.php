<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccionesUsuario;
use Illuminate\Support\Facades\Validator;

class AccionesUsuarioController extends Controller
{
    public function index()
    {
        try {
            $acciones = AccionesUsuario::all();
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Acciones de usuario listadas correctamente',
                'data' => $acciones
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al listar acciones de usuario: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'accion' => 'required|string',
            'users_id' => 'required|exists:users,id',
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
            $accion = AccionesUsuario::create($request->all());
            return response()->json([
                'success' => true,
                'status' => 201,
                'message' => 'Acción de usuario creada correctamente',
                'data' => $accion
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al crear acción de usuario: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function show($id)
    {
        try {
            $accion = AccionesUsuario::findOrFail($id);
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Acción de usuario encontrada',
                'data' => $accion
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 404,
                'message' => 'Acción de usuario no encontrada',
                'data' => null
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'accion' => 'required|string',
            'users_id' => 'required|exists:users,id',
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
            $accion = AccionesUsuario::findOrFail($id);
            $accion->update($request->all());
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Acción de usuario actualizada correctamente',
                'data' => $accion
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al actualizar acción de usuario: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $accion = AccionesUsuario::findOrFail($id);
            $accion->delete();
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Acción de usuario eliminada correctamente',
                'data' => null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al eliminar acción de usuario: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }
}
