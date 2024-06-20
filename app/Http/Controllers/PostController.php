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
        // Validação dos dados da requisição
        $validatedData = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'content' => 'required|string',
            'tags' => 'required|array',
            'tags.*' => 'string',
        ]);

        // Criação da nova postagem
        $post = Post::create([
            'title' => $validatedData['title'],
            'author' => $validatedData['author'],
            'content' => $validatedData['content'],
            'tags' => $validatedData['tags'],
        ]);

        // Retornar resposta de sucesso com status 201 Created
        return response()->json($post, 201);
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
    public function update(Request $request, $id)
    {
        // Validar os dados recebidos na requisição
        $validatedData = $request->validate([
            'title' => 'sometimes|string|max:255',
            'author' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'tags' => 'sometimes|array'
        ]);

        // Buscar o post pelo ID
        $post = Post::findOrFail($id);

        // Atualizar os campos que foram recebidos na requisição
        $post->update($validatedData);

        // Retornar o post atualizado
        return response()->json($post, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
