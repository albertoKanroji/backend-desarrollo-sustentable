<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use OpenApi\Annotations as OA;

class ComentarioController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/comentarios",
     *     operationId="listarComentarios",
     *     tags={"Comentarios"},
     *     summary="Listar todos los comentarios",
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa"
     *     )
     * )
     */
    public function index()
    {
        try {
            $comentarios = Comentario::all();
            return response()->json($comentarios);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/comentarios",
     *     operationId="crearComentario",
     *     tags={"Comentarios"},
     *     summary="Crear un nuevo comentario",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Comentario")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Comentario creado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación"
     *     )
     * )
     */
    public function store(Request $request)
    {
        try {
            $comentario = Comentario::create($request->all());
            return response()->json($comentario, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/comentarios/{id}",
     *     operationId="mostrarComentario",
     *     tags={"Comentarios"},
     *     summary="Obtener un comentario por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del comentario",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Comentario encontrado"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Comentario no encontrado"
     *     )
     * )
     */
    public function show($id)
    {
        try {
            $comentario = Comentario::findOrFail($id);
            return response()->json($comentario);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/comentarios/{id}",
     *     operationId="actualizarComentario",
     *     tags={"Comentarios"},
     *     summary="Actualizar un comentario existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del comentario",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Comentario")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Comentario actualizado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Comentario no encontrado"
     *     )
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/comentarios/{id}",
     *     operationId="eliminarComentario",
     *     tags={"Comentarios"},
     *     summary="Eliminar un comentario",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del comentario",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Comentario eliminado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Comentario no encontrado"
     *     )
     * )
     */
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
