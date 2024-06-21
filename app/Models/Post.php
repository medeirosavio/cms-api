<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Post",
 *     type="object",
 *     title="Post",
 *     description="Post Model",
 *     required={"title", "author", "content", "tags"},
 *     @OA\Property(property="id", type="integer", readOnly=true),
 *     @OA\Property(property="title", type="string"),
 *     @OA\Property(property="author", type="string"),
 *     @OA\Property(property="content", type="string"),
 *     @OA\Property(property="tags", type="array", @OA\Items(type="string"))
 * )
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'content', 'tags'];

    protected $casts = [
        'tags' => 'json', // Define a coluna 'tags' como JSON
    ];
}

