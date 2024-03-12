<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::all();
            return response()->json($posts);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $post = Post::create($request->all());
            return response()->json($post, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $post = Post::findOrFail($id);
            return response()->json($post);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->update($request->all());
            return response()->json($post, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
