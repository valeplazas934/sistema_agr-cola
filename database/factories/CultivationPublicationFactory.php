<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CultivationPublicationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cropTitle' => $this->faker->sentence,
            'cropContent' => $this->faker->paragraph,
            'idUser' => User::factory(),
            'idCategory' => Category::factory(),
            'creationDate' => now(),
        ];
    }
}