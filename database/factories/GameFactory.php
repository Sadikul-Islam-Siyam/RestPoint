<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Game>
 */
class GameFactory extends Factory
{
    protected $model = Game::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'genre' => $this->faker->randomElement(['Action RPG', 'Rogue-like', 'FPS', 'Metroidvania', 'Platformer']),
            'platforms' => ['PC', 'PS5', 'Xbox'],
            'developer' => $this->faker->company(),
            'release_date' => $this->faker->date(),
            'trailer_url' => 'https://www.youtube.com/embed/fW4fGf8f-y4',
        ];
    }
}
