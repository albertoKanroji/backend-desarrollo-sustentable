<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Hash;


class UsuarioController extends Controller
{
    public function index()
    {
        try {
            $usuarios = Usuarios::all();
            return response()->json($usuarios);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $usuario = new Usuarios();
            $usuario->nombre_usuario = $request->nombre_usuario;
            $usuario->correo_electronico = $request->correo_electronico;
            $usuario->contrasena = Hash::make($request->contrasena);
            $usuario->save();
            return response()->json($usuario, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $usuario = Usuarios::findOrFail($id);
            return response()->json($usuario);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request, $id)
{
    try {
        $usuario = Usuarios::findOrFail($id);
        
        // Verificar si se proporciona un nuevo nombre de usuario
        if ($request->has('nombre_usuario')) {
            $usuario->nombre_usuario = $request->nombre_usuario;
        }

        // Verificar si se proporciona un nuevo correo electrónico
        if ($request->has('correo_electronico')) {
            $usuario->correo_electronico = $request->correo_electronico;
        }

        // Verificar si se proporciona una nueva contraseña
        if ($request->has('contrasena')) {
            $usuario->contrasena = Hash::make($request->contrasena);
        }
        
        $usuario->save();
        return response()->json($usuario, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


    public function destroy($id)
    {
        try {
            $usuario = Usuarios::findOrFail($id);
            $usuario->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
