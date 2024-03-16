<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccionesUsuariosClientes;
use Illuminate\Support\Facades\Validator;

class AccionesUsuariosClientesController extends Controller
{
    public function index()
    {
        try {
            $acciones = AccionesUsuariosClientes::all();
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Acciones de usuarios clientes listadas correctamente',
                'data' => $acciones
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al listar acciones de usuarios clientes: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'accion' => 'required|string',
            'usuariosClientes_id' => 'required|exists:usuariosClientes,id',
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
            $accion = AccionesUsuariosClientes::create($request->all());
            return response()->json([
                'success' => true,
                'status' => 201,
                'message' => 'Acción de usuario cliente creada correctamente',
                'data' => $accion
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al crear acción de usuario cliente: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function show($id)
    {
        try {
            $accion = AccionesUsuariosClientes::findOrFail($id);
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Acción de usuario cliente encontrada',
                'data' => $accion
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 404,
                'message' => 'Acción de usuario cliente no encontrada',
                'data' => null
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'accion' => 'required|string',
            'usuariosClientes_id' => 'required|exists:usuariosClientes,id',
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
            $accion = AccionesUsuariosClientes::findOrFail($id);
            $accion->update($request->all());
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Acción de usuario cliente actualizada correctamente',
                'data' => $accion
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al actualizar acción de usuario cliente: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $accion = AccionesUsuariosClientes::findOrFail($id);
            $accion->delete();
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Acción de usuario cliente eliminada correctamente',
                'data' => null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al eliminar acción de usuario cliente: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }
}
