<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsCommentFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => random_int(1, 10),
            'news_id' => random_int(1, 10),
            'parent_id' => null,
            'content' => $this->faker->text(random_int(100, 500)),
        ];
    }
}
