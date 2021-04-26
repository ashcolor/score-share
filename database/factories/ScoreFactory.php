<?php

namespace Database\Factories;

use App\Models\Score;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Score::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_at' => $this->faker->date,
            'updated_at' => $this->faker->date,
            'title' => $this->faker->sentence(3),
            'artist' => $this->faker->optional(0.8)->sentence(2),
            'score_created_by' => $this->faker->numberBetween(1, 30),
            'score_created_at' => $this->faker->date,
            'score_updated_at' => $this->faker->date,
            'genre' => $this->faker->word,
            'remarks' => $this->faker->optional(0.8)->realText(100),
            'url' => $this->faker->optional(0.5)->url,
        ];
    }
}
