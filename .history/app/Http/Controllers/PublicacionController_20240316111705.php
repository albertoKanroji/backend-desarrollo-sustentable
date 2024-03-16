<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use App\Models\PublicacionDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicacionController extends Controller
{
    public function index()
    {
        try {
            $publicaciones = Publicacion::with(['categoria', 'imagenes', 'usuarios', 'tags', 'detalle'])->get();
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Publicaciones listadas correctamente',
                'data' => $publicaciones
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al listar publicaciones: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }
    

    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string',
            'subTitulo' => 'required|string',
            'descripcion' => 'required|string',
            'categoriasPublicaciones_id' => 'required|integer|exists:categoriasPublicaciones,id',
            'tags' => 'required|array',
            'tags.*' => 'integer|exists:tags,id',
            'users_id' => 'required|integer|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status' => 422,
                'message' => 'Error de validación',
                'data' => $validator->errors()
            ], 422);
        }

        // Crear la publicación
        try {
            $publicacion = Publicacion::create($request->all());

            // Crear el detalle de la publicación
            $publicacionDetalle = new PublicacionDetalle([
                'users_id' => $request->idUserAutor,
                'publicaciones_id' => $publicacion->id
            ]);
            $publicacionDetalle->save();

            // Adjuntar los tags a la publicación
            $publicacion->tags()->attach($request->tags);

            return response()->json([
                'success' => true,
                'status' => 201,
                'message' => 'Publicación creada correctamente',
                'data' => $publicacion
            ], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al crear la publicación: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }


    public function show($id)
    {
        try {
            $publicacion = Publicacion::findOrFail($id);
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Publicación encontrada',
                'data' => $publicacion
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 404,
                'message' => 'Publicación no encontrada',
                'data' => null
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string',
            'subTitulo' => 'required|string',
            'descripcion' => 'required|string',
            'categoriasPublicaciones_id' => 'required|integer|exists:categoriasPublicaciones,id',
            'idUserAutor' => 'required|integer|exists:users,id'
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
            $publicacion = Publicacion::findOrFail($id);
            $publicacion->update($request->all());

            $publicacionDetalle = PublicacionDetalle::where('publicaciones_id', $id)->first();
            if (!$publicacionDetalle) {
                return response()->json([
                    'success' => false,
                    'status' => 404,
                    'message' => 'Detalle de publicación no encontrado',
                    'data' => null
                ], 404);
            }
            $publicacionDetalle->update([
                'idUserAutor' => $request->idUserAutor,
                'users_id' => $request->idUserAutor,
            ]);

            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Publicación actualizada correctamente',
                'data' => $publicacion
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al actualizar publicación: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $publicacion = Publicacion::findOrFail($id);
            $publicacion->delete();
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Publicación eliminada correctamente',
                'data' => null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al eliminar publicación: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }
}
