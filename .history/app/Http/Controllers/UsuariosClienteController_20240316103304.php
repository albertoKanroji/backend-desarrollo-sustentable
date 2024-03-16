<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuariosCliente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuariosClienteController extends Controller
{
    public function index()
    {
        try {
            $usuarios = UsuariosCliente::select('id', 'nombreCliente', 'usuarioApellidoPaterno', 'usuarioApellidoMaterno', 'usuarioEmail')->get();
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Usuarios listados correctamente',
                'data' => $usuarios
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al listar usuarios: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombreCliente' => 'required|string',
            'usuarioApellidoPaterno' => 'required|string',
            'usuarioApellidoMaterno' => 'required|string',
            'usuarioEmail' => 'required|email|unique:usuariosClientes',
            'usuarioPassword' => 'required|string|min:6',
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
            $usuarioData = $request->all();
            $usuarioData['usuarioPassword'] = Hash::make($request->usuarioPassword);
            $usuario = UsuariosCliente::create($usuarioData);
            return response()->json([
                'success' => true,
                'status' => 201,
                'message' => 'Usuario creado correctamente',
                'data' => $usuario
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al crear usuario: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usuarioEmail' => 'required|email',
            'usuarioPassword' => 'required|string',
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
            $usuario = UsuariosCliente::where('usuarioEmail', $request->usuarioEmail)->first();
            if (!$usuario || !Hash::check($request->usuarioPassword, $usuario->usuarioPassword)) {
                return response()->json([
                    'success' => false,
                    'status' => 401,
                    'message' => 'Credenciales inválidas',
                    'data' => null
                ], 401);
            }

            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Inicio de sesión exitoso',
                'data' => $usuario
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al iniciar sesión: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function show($id)
{
    try {
        $usuario = UsuariosCliente::select('id', 'nombreCliente', 'usuarioApellidoPaterno', 'usuarioApellidoMaterno', 'usuarioEmail')->findOrFail($id);
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Usuario encontrado',
            'data' => $usuario
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'status' => 404,
            'message' => 'Usuario no encontrado',
            'data' => null
        ], 404);
    }
}

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombreCliente' => 'required|string',
            'usuarioApellidoPaterno' => 'required|string',
            'usuarioApellidoMaterno' => 'required|string',
            'usuarioEmail' => 'required|email|unique:usuariosClientes,usuarioEmail,' . $id,
            'usuarioPassword' => 'required|string|min:6',
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
            $usuario = UsuariosCliente::findOrFail($id);
            $usuarioData = $request->all();
            $usuarioData['usuarioPassword'] = Hash::make($request->usuarioPassword);
            $usuario->update($usuarioData);
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Usuario actualizado correctamente',
                'data' => $usuario
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al actualizar usuario: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $usuario = UsuariosCliente::findOrFail($id);
            $usuario->delete();
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Usuario eliminado correctamente',
                'data' => null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al eliminar usuario: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }
}

