<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title' => $this->faker->text(50),
            'body' => $this->faker->text(500),
            // 'user_id' => 1, //just for now before sedder with relationships
        ];
    }
}
