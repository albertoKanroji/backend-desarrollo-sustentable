<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacto;
use App\Models\ContactoClientesDetalle;
use Illuminate\Support\Facades\Validator;

class ContactoController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $validator = Validator::make($request->all(), [
            'comentario' => 'required|string',
            'usuarios_clientes_id' => 'required',
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
            // Crear el contacto
            $contacto = Contacto::create(['comentario' => $request->comentario]);

            // Crear el detalle del contacto
            $detalle =  ContactoClientesDetalle::create([
                'usuarios_clientes_id' => $request->usuarios_clientes_id,
                'contacto_id' => $contacto->id
            ]);
            $detalle->save();

            return response()->json([
                'success' => true,
                'status' => 201,
                'message' => 'Contacto creado correctamente',
                'data' => $contacto
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al crear el contacto: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }


    public function show($id)
    {
        try {
            $contacto = Contacto::with('detalles', 'detalles.cliente')->findOrFail($id);
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Contacto encontrado',
                'data' => $contacto
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 404,
                'message' => 'Contacto no encontrado',
                'data' => null
            ], 404);
        }
    }

    public function index()
    {
        try {
            $contactos = Contacto::with('detalles','')->get();
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Contactos listados correctamente',
                'data' => $contactos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al listar contactos: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $contacto = Contacto::findOrFail($id);
            $contacto->delete();
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Contacto eliminado correctamente',
                'data' => null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al eliminar contacto: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }
}
