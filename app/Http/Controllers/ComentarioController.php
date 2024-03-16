<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Models\ComentarioDetalle;
use Illuminate\Support\Facades\Validator;

class ComentarioController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $validator = Validator::make($request->all(), [
            'comentario' => 'required|string',
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
            // Crear el comentario
            $comentario = Comentario::create($request->all());

            // Crear el detalle del comentario
            $comentarioDetalle = new ComentarioDetalle([
                'comentarios_id' => $comentario->id,
                'usuariosClientes_id' => $request->usuariosClientes_id,
                'publicacion_id' => $request->publicacion_id
            ]);
            $comentarioDetalle->save();

            return response()->json([
                'success' => true,
                'status' => 201,
                'message' => 'Comentario creado correctamente',
                'data' => $comentario
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al crear el comentario: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function show($id)
    {
        try {
            // Obtener el comentario por su ID con sus detalles
            $comentario = Comentario::with('detalles')->findOrFail($id);
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Comentario encontrado',
                'data' => $comentario
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 404,
                'message' => 'Comentario no encontrado',
                'data' => null
            ], 404);
        }
    }

    public function index()
    {
        try {
            // Listar todos los comentarios con sus detalles
            $comentarios = Comentario::with('detalles')->get();
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Comentarios listados correctamente',
                'data' => $comentarios
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al listar comentarios: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            // Buscar y eliminar el comentario por su ID
            $comentario = Comentario::findOrFail($id);
            $comentario->delete();
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Comentario eliminado correctamente',
                'data' => null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al eliminar comentario: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }
}
