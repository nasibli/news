<?php

namespace Database\Seeders;

use App\Models\NewsComment;
use App\Models\User;
use App\Models\News;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->createUsers();
        $this->createNewsAndComments();
    }

    private function createUsers()
    {
        User::factory()->create([
            'name' => 'Ivanov Ivan',
            'email' => 'ivanov.ivan@mail.ru',
        ]);
        User::factory(9)->create();
    }

    private function createNewsAndComments()
    {
        News::factory(10)->create();

        NewsComment::factory(5)->create([
            'news_id' => 1,
        ]);

        NewsComment::factory(5)->create([
            'news_id' => 1,
            'parent_id' => 1,
        ]);

        NewsComment::factory(30)->create();
    }
}
