<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lvlOne = factory(Corp\Comment::class, 10)->create();

        $data = [];
        foreach ($lvlOne as $item) {
            $data[$item->article_id][] = $item->id;
        }

        $lvlTwo = factory(Corp\Comment::class, 30)->create()->each(function ($comment) use ($data) {
            if (isset($data[$comment->article_id])) {
                $comment->parent_id = $data[$comment->article_id][array_rand($data[$comment->article_id])];
            } else {
                $comment->parent_id = 0;
            }

            $comment->save();
        });
    }
}
