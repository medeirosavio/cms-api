<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Verifica se há um parâmetro 'tag' na query da requisição
        if ($request->has('tag')) {
            $tag = $request->tag;

            // Filtra os posts que contêm a tag especificada
            $posts = Post::whereJsonContains('tags', $tag)->get();

            return response()->json($posts);
        }

        // Caso não haja o parâmetro 'tag', retorna todos os posts
        $posts = Post::all();
        return response()->json($posts);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
