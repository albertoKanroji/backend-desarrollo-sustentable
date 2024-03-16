<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuariosCliente;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class UsuariosClienteController extends Controller
{
    
    public function listarUsuarios()
    {
        try {
            $usuarios = UsuariosCliente::all();
            return response()->json(['success' => true, 'data' => $usuarios]);
        } catch (QueryException $e) {
            return response()->json(['success' => false, 'error' => 'Error de la base de datos: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error de conexión: ' . $e->getMessage()]);
        }
    }

    public function crearUsuario(Request $request)
    {
        try {
            $usuario = UsuariosCliente::create($request->all());
            return response()->json(['success' => true, 'data' => $usuario], 201);
        } catch (QueryException $e) {
            return response()->json(['success' => false, 'error' => 'Error de la base de datos: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error de conexión: ' . $e->getMessage()]);
        }
    }

    public function editarUsuario(Request $request, $id)
    {
        try {
            $usuario = UsuariosCliente::findOrFail($id);
            $usuario->update($request->all());
            return response()->json(['success' => true, 'data' => $usuario]);
        } catch (QueryException $e) {
            return response()->json(['success' => false, 'error' => 'Error de la base de datos: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error de conexión: ' . $e->getMessage()]);
        }
    }

    public function buscarUsuario($id)
    {
        try {
            $usuario = UsuariosCliente::findOrFail($id);
            return response()->json(['success' => true, 'data' => $usuario]);
        } catch (QueryException $e) {
            return response()->json(['success' => false, 'error' => 'Error de la base de datos: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error de conexión: ' . $e->getMessage()]);
        }
    }

    public function eliminarUsuario($id)
    {
        try {
            $usuario = UsuariosCliente::findOrFail($id);
            $usuario->delete();
            return response()->json(['success' => true, 'message' => 'Usuario eliminado correctamente']);
        } catch (QueryException $e) {
            return response()->json(['success' => false, 'error' => 'Error de la base de datos: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error de conexión: ' . $e->getMessage()]);
        }
    }
}
