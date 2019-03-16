<?php

namespace Corp\Repositories;

use Corp\Article;

class ArticlesRepository extends Repository
{
    public function __construct(Article $articles)
    {
        $this->model = $articles;
    }

    public function oneByAlias($alias, $attr = [])
    {
        $article = parent::oneByAlias($alias, $attr);

        if ($article && !empty($attr)) {
            $article->load('comments');
            $article->comments->load('user');
        }

        if ($article && $article->img) {
            $article->img = json_decode($article->img);
        }

        return $article;
    }

    public function find($item)
    {
        return $this->model->find($item);
    }
}
