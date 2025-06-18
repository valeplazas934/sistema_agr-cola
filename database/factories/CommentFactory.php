<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\CultivationPublication;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'content' => $this->faker->sentence(),
            'creationDate' => now(),
            'idUser' => User::factory(),
            'idCultivationPublication' => CultivationPublication::factory(),
            'parent_id' => null,
        ];
    }
}