<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="API Documentation",
 *     version="1.0",
 *     description="API Documentation for the CMS"
 * )
 */
class PostController extends Controller
{
   /**
     * @OA\Get(
     *     path="/posts",
     *     summary="List all posts",
     *     @OA\Parameter(
     *         name="tag",
     *         in="query",
     *         description="Tag to filter posts by",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Post"))
     *     )
     * )
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
     * @OA\Post(
     *     path="/posts",
     *     summary="Create a new post",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Post created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     )
     * )
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
     * @OA\Put(
     *     path="/posts/{id}",
     *     summary="Update a post",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     )
     * )
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
     * @OA\Delete(
     *     path="/posts/{id}",
     *     summary="Delete a post",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Post deleted successfully"
     *     )
     * )
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(null, 204);
    }
}
