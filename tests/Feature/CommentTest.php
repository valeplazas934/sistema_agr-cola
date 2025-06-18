<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use App\Models\CultivationPublication;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $publication;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $category = Category::factory()->create();

        $this->publication = CultivationPublication::factory()->create([
            'idUser' => $this->user->id,
            'idCategory' => $category->id,
        ]);
    }

    public function test_user_can_post_a_comment()
    {
        $this->actingAs($this->user);

        $response = $this->post('/comments', [
            'content' => 'Este es un comentario',
            'creationDate' => now(),
            'idUser' => $this->user->id,
            'idCultivationPublication' => $this->publication->id,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('comments', ['content' => 'Este es un comentario']);
    }

    public function test_user_can_reply_to_a_comment()
    {
        $this->actingAs($this->user);

        $parentComment = Comment::factory()->create([
            'idUser' => $this->user->id,
            'idCultivationPublication' => $this->publication->id,
        ]);

        $response = $this->post('/comments', [
            'content' => 'Respuesta al comentario',
            'creationDate' => now(),
            'idUser' => $this->user->id,
            'idCultivationPublication' => $this->publication->id,
            'parent_id' => $parentComment->id,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('comments', ['content' => 'Respuesta al comentario']);
    }
}