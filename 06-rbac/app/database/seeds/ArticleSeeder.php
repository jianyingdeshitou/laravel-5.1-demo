<?php

use Illuminate\Database\Seeder;

use App\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Article::truncate();
        factory(Article::class, 30)->create();
    }
}
