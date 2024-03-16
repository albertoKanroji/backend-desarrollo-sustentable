<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaPublicacion;
use Illuminate\Support\Facades\Validator;

class CategoriaPublicacionController extends Controller
{
    public function index()
    {
        try {
            $categorias = CategoriaPublicacion::all();
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Categorías listadas correctamente',
                'data' => $categorias
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al listar categorías: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombreCategoria' => 'required|string',
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
            $categoria = CategoriaPublicacion::create($request->all());
            return response()->json([
                'success' => true,
                'status' => 201,
                'message' => 'Categoría creada correctamente',
                'data' => $categoria
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al crear categoría: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function show($id)
    {
        try {
            $categoria = CategoriaPublicacion::findOrFail($id);
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Categoría encontrada',
                'data' => $categoria
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 404,
                'message' => 'Categoría no encontrada',
                'data' => null
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombreCategoria' => 'required|string',
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
            $categoria = CategoriaPublicacion::findOrFail($id);
            $categoria->update($request->all());
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Categoría actualizada correctamente',
                'data' => $categoria
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al actualizar categoría: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $categoria = CategoriaPublicacion::findOrFail($id);
            $categoria->delete();
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Categoría eliminada correctamente',
                'data' => null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al eliminar categoría: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }
}
