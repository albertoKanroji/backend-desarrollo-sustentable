<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosClienteController;


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


    Route::prefix('posts')->group(function () {
        // Route::get('/listar', [PostController::class, 'index'])->name('posts.listar');
        // Route::post('/crear', [PostController::class, 'store'])->name('posts.crear');
        // Route::get('/mostrar/{id}', [PostController::class, 'show'])->name('posts.mostrar');
        // Route::put('/editar/{id}', [PostController::class, 'update'])->name('posts.editar');
        // Route::delete('/borrar/{id}', [PostController::class, 'destroy'])->name('posts.borrar');
    });

    Route::prefix('comentarios')->group(function () {
        // Route::get('/listar', [ComentarioController::class, 'index'])->name('comentarios.listar');
        // Route::post('/crear', [ComentarioController::class, 'store'])->name('comentarios.crear');
        // Route::get('/mostrar/{id}', [ComentarioController::class, 'show'])->name('comentarios.mostrar');
        // Route::put('/editar/{id}', [ComentarioController::class, 'update'])->name('comentarios.editar');
        // Route::delete('/borrar/{id}', [ComentarioController::class, 'destroy'])->name('comentarios.borrar');
    });
});
