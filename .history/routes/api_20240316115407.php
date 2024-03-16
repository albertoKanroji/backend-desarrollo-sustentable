<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosClienteController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\CategoriaPublicacionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ComentarioController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {

    Route::prefix('usuarios')->group(function () {

        Route::get('/', [UsuariosClienteController::class, 'index'])->name('usuarios.index');
        Route::post('/login', [UsuariosClienteController::class, 'login'])->name('usuarios.login');
        Route::post('/', [UsuariosClienteController::class, 'store'])->name('usuarios.store');
        Route::get('/{id}', [UsuariosClienteController::class, 'show'])->name('usuarios.show');
        Route::put('/{id}', [UsuariosClienteController::class, 'update'])->name('usuarios.update');
        Route::delete('/{id}', [UsuariosClienteController::class, 'destroy'])->name('usuarios.destroy');
    });


    Route::prefix('publicaciones')->group(function () {
        Route::get('/', [PublicacionController::class, 'index']); // Listar todas las publicaciones
        Route::post('/', [PublicacionController::class, 'store']); // Crear una nueva publicación
        Route::get('/{id}', [PublicacionController::class, 'show']); // Mostrar una publicación por su ID
        Route::put('/{id}', [PublicacionController::class, 'update']); // Actualizar una publicación por su ID
        Route::delete('/{id}', [PublicacionController::class, 'destroy']); // Eliminar una publicación por su ID
    });

    Route::prefix('categorias')->group(function () {
        Route::get('/', [CategoriaPublicacionController::class, 'index']);
        Route::post('/', [CategoriaPublicacionController::class, 'store']);
        Route::get('/{id}', [CategoriaPublicacionController::class, 'show']);
        Route::put('/{id}', [CategoriaPublicacionController::class, 'update']);
        Route::delete('/{id}', [CategoriaPublicacionController::class, 'destroy']);
    });


    Route::prefix('tags')->group(function () {
        Route::get('/', [TagController::class, 'index']); // Obtener todos los tags
        Route::post('/', [TagController::class, 'store']); // Crear un nuevo tag
        Route::get('/{id}', [TagController::class, 'show']); // Obtener un tag por su ID
        Route::put('/{id}', [TagController::class, 'update']); // Actualizar un tag por su ID
        Route::delete('/{id}', [TagController::class, 'destroy']); // Eliminar un tag por su ID
    });

    Route::prefix('comentarios')->group(function () {
        Route::post('/', [ComentarioController::class, 'store']);
        Route::get('/', [ComentarioController::class, 'index']);
        Route::get('/{id}', [ComentarioController::class, 'show']);
        Route::delete('/{id}', [ComentarioController::class, 'destroy']);
    });



});
