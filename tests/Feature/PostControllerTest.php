<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test listing all posts.
     *
     * @return void
     */
    public function test_can_list_all_posts()
    {
        // Create sample posts
        Post::factory()->count(3)->create();

        // Make GET request to /posts
        $response = $this->get('/posts');

        // Assert that the response status is 200
        $response->assertStatus(200);

        // Assert that the response has the correct structure
        $response->assertJsonStructure([
            '*' => ['id', 'title', 'author', 'content', 'tags']
        ]);
    }

    /**
     * Test filtering posts by tag.
     *
     * @return void
     */
    public function test_can_filter_posts_by_tag()
    {
        // Create sample posts
        Post::factory()->create(['tags' => ['tag1']]);
        Post::factory()->create(['tags' => ['tag2']]);

        // Make GET request to /posts?tag=tag1
        $response = $this->get('/posts?tag=tag1');

        // Assert that the response status is 200
        $response->assertStatus(200);

        // Assert that the response contains only the post with the specified tag
        $response->assertJsonFragment(['tags' => ['tag1']]);
        $response->assertJsonMissing(['tags' => ['tag2']]);
    }

    /**
     * Test creating a new post.
     *
     * @return void
     */
    public function test_can_create_post()
    {
        // Post data
        $postData = [
            'title' => 'New Post',
            'author' => 'Author Name',
            'content' => 'Post content',
            'tags' => ['tag1', 'tag2']
        ];

        // Make POST request to /posts
        $response = $this->postJson('/posts', $postData);

        // Assert that the response status is 201
        $response->assertStatus(201);

        // Assert that the response has the correct structure
        $response->assertJsonFragment($postData);

        // Assert that the post is in the database
        $this->assertDatabaseHas('posts', [
            'title' => 'New Post',
            'author' => 'Author Name',
            'content' => 'Post content'
        ]);
    }

    /**
     * Test updating a post.
     *
     * @return void
     */
    public function test_can_update_post()
    {
        // Create a sample post
        $post = Post::factory()->create();

        // Updated post data
        $updatedData = [
            'title' => 'Updated Title',
            'author' => 'Updated Author',
            'content' => 'Updated content',
            'tags' => ['updated', 'tags']
        ];

        // Make PUT request to /posts/{id}
        $response = $this->putJson("/posts/{$post->id}", $updatedData);

        // Assert that the response status is 200
        $response->assertStatus(200);

        // Assert that the response has the correct structure
        $response->assertJsonFragment($updatedData);

        // Assert that the post is updated in the database
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Title',
            'author' => 'Updated Author',
            'content' => 'Updated content'
        ]);
    }

    /**
     * Test deleting a post.
     *
     * @return void
     */
    public function test_can_delete_post()
    {
        // Create a sample post
        $post = Post::factory()->create();

        // Make DELETE request to /posts/{id}
        $response = $this->deleteJson("/posts/{$post->id}");

        // Assert that the response status is 204
        $response->assertStatus(204);

        // Assert that the post is deleted from the database
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}

