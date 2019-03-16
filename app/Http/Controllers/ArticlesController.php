<?php

namespace Corp\Http\Controllers;

use Corp\Services\ArticleServices;

class ArticlesController extends SiteController
{
    public function __construct(ArticleServices $articleServices)
    {
        parent::__construct();

        $this->service = $articleServices;
        $this->bar = 'right';
        $this->template = config('settings.theme') . '.articles';
    }

    /**
     * @param bool $cat_alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index($cat_alias = false)
    {
        $this->title = 'Блог';
        $this->keywords = 'String';
        $this->meta_desc = 'String';

        $articles = $this->service->getArticles($cat_alias);
        $content = view(config('settings.theme') . '.articles_content',compact('articles'))->render();
        $this->vars = array_add($this->vars, 'content', $content);

        $comments = $this->service->getComments(config('settings.recent_comments'));
        $portfolios = $this->service->getPortfolios(config('settings.recent_portfolios'));
        $this->contentRightBar = view(config('settings.theme') . '.articlesBar',compact('comments','portfolios'))->render();

        return $this->renderOutput();
    }

    /**
     * @param bool $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function show($alias = false)
    {
        $article = $this->service->getOneArticle($alias);

        if (isset($article->id)) {
            $this->title = $article->title;
            $this->keywords = $article->keywords;
            $this->meta_desc = $article->meta_desc;
        }

        $content = view(config('settings.theme') . '.article_content',compact('article'))->render();
        $this->vars = array_add($this->vars, 'content', $content);

        $comments = $this->service->getComments(config('settings.recent_comments'));
        $portfolios = $this->service->getPortfolios(config('settings.recent_portfolios'));
        $this->contentRightBar = view(config('settings.theme') . '.articlesBar',compact('comments', 'portfolios'))->render();

        return $this->renderOutput();
    }
}
