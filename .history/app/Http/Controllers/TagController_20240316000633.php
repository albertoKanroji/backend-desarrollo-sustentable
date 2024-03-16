<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function index()
    {
        try {
            $tags = Tag::all();
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Tags listados correctamente',
                'data' => $tags
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al listar tags: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombreTag' => 'required|string',
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
            $tag = Tag::create($request->all());
            return response()->json([
                'success' => true,
                'status' => 201,
                'message' => 'Tag creado correctamente',
                'data' => $tag
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al crear tag: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function show($id)
    {
        try {
            $tag = Tag::findOrFail($id);
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Tag encontrado',
                'data' => $tag
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 404,
                'message' => 'Tag no encontrado',
                'data' => null
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombreTag' => 'required|string',
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
            $tag = Tag::findOrFail($id);
            $tag->update($request->all());
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Tag actualizado correctamente',
                'data' => $tag
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al actualizar tag: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $tag = Tag::findOrFail($id);
            $tag->delete();
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Tag eliminado correctamente',
                'data' => null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al eliminar tag: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }
}
