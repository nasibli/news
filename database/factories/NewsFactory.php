<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->text(random_int(100, 200)),
            'content' => $this->faker->realText(),
        ];
    }
}
