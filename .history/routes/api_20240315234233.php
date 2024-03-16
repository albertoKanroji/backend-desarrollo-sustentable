<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



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
        // Route::get('/listar', [UsuarioController::class, 'index'])->name('usuarios.listar');
        // Route::post('/crear', [UsuarioController::class, 'store'])->name('usuarios.crear');
        // Route::get('/mostrar/{id}', [UsuarioController::class, 'show'])->name('usuarios.mostrar');
        // Route::put('/editar/{id}', [UsuarioController::class, 'update'])->name('usuarios.editar');
        // Route::delete('/borrar/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.borrar');
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
