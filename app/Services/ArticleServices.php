<?php

namespace Corp\Services;

use Corp\Repositories\CategoriesRepository;
use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\CommentsRepository;

class ArticleServices extends Services
{
    protected $cat_rep;

    public function __construct(PortfoliosRepository $p_rep, ArticlesRepository $a_rep, CommentsRepository $c_rep, CategoriesRepository $cat_rep)
    {
        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));

        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;
        $this->c_rep = $c_rep;
        $this->cat_rep = $cat_rep;
    }

    public function getArticles($alias = false)
    {
        $where = false;

        if ($alias) {
            $id = $this->cat_rep->getCategoryIdByAlias($alias);
            $where = ['category_id', $id];
        }

        $articles = $this->a_rep->get([
            'id',
            'title',
            'alias',
            'created_at',
            'img',
            'desc',
            'user_id',
            'category_id',
            'keywords',
            'meta_desc'
        ],
            false, true, $where, 'id');

        if ($articles) {
            $articles->load('user', 'category', 'comments');
        }

        return $articles;
    }

    public function getComments($take)
    {
        $comments = $this->c_rep->get(['text', 'name', 'email', 'site', 'article_id', 'user_id'], $take, false, false, 'id');

        if ($comments) {
            $comments->load('article', 'user');
        }

        return $comments;
    }

    public function getPortfolios($take)
    {
        $portfolios = $this->p_rep->get(['title', 'text', 'alias', 'img'], $take,false, false, 'id');

        return $portfolios;
    }

    public function getOneArticle($alias)
    {
        $article = $this->a_rep->oneByAlias($alias, ['comments' => true]);

        return $article;
    }
}
