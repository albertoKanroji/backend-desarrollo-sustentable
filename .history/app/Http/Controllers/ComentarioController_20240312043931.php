<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\\Comentario;


class ComentarioController extends Controller
{
    public function index()
    {
        try {
            $comentarios = Comentario::all();
            return response()->json($comentarios);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $comentario = Comentario::create($request->all());
            return response()->json($comentario, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $comentario = Comentario::findOrFail($id);
            return response()->json($comentario);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $comentario = Comentario::findOrFail($id);
            $comentario->update($request->all());
            return response()->json($comentario, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $comentario = Comentario::findOrFail($id);
            $comentario->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
