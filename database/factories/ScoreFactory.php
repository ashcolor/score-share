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
            'title' => $this->faker->word,
            'artist' => $this->faker->firstName,
            'score_created_by' => User::factory()->create()->id,
            'score_created_at' => $this->faker->date,
            'score_modified_at' => $this->faker->date,
            'genre' => $this->faker->word,
            'remarks' => $this->faker->text(100),
            'url' => $this->faker->url,
        ];
    }
}
