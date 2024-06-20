<?php

// database/seeders/PostSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'title' => 'Notion',
                'author' => 'Marcia Thiel',
                'content' => 'Sed soluta nemo et consectetur reprehenderit ea reprehenderit sit.',
                'tags' => ['organization', 'planning', 'collaboration', 'writing', 'calendar'],
            ],
            [
                'title' => 'json-server',
                'author' => 'Eldora Schinner',
                'content' => 'Laudantium illum modi tenetur possimus natus.',
                'tags' => ['api', 'json', 'schema', 'node', 'github', 'rest'],
            ],
            [
                'title' => 'fastify',
                'author' => 'Delpha Balistreri',
                'content' => 'Eos corrupti qui omnis error repellendus commodi praesentium necessitatibus alias.',
                'tags' => ['web', 'framework', 'node', 'http2', 'https', 'localhost'],
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
