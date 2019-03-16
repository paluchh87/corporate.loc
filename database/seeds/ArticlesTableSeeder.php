<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Corp\Article::class, 8)->create()->each(function ($article) {
            $article->alias = $article->alias . '-' . $article->id;
            $article->img = '{"mini":"' . $article->id . '_mini.jpg","max":"' . $article->id . '_max.jpg","path":"' . $article->id . '.jpg"}';

            $article->save();
        });
    }
}
