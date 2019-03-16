<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Services\Admin\ArticleServices;
use Corp\Http\Requests\ArticleRequest;
use Corp\Article;

class ArticlesController extends AdminController
{
    public function __construct(ArticleServices $articleServices)
    {
        parent::__construct();

        $this->service = $articleServices;
        $this->template = config('settings.theme') . '.admin.articles';
    }

    /**
     * Display a listing of the resource.
     *
     * @throws
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('VIEW_ADMIN_ARTICLES');

        $this->title = 'Менеджер статтей';
        $articles = $this->service->getArticles();
        $this->content = view(config('settings.theme') . '.admin.articles_content', compact('articles'))->render();

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('save', new Article);
        $this->title = "Добавить новый материал";

        $categories = $this->service->getCategories();
        $this->content = view(config('settings.theme') . '.admin.articles_create_content',
            compact('categories'))->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @throws
     * @param  ArticleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article;
        $this->authorize('save', $article);
        $result = $this->service->addArticle($request, $article);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('adminIndex')->with($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @throws
     * @param  Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Article $article)
    {
        $this->authorize('edit', $article);
        $article->img = json_decode($article->img);

        $categories = $this->service->getCategories();
        $this->title = 'Реадактирование материала - ' . $article->title;
        $this->content = view(config('settings.theme') . '.admin.articles_create_content',
            compact('categories', 'article'))->render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws
     * @param  ArticleRequest $request
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $this->authorize('edit', $article);
        $result = $this->service->updateArticle($request, $article);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('adminIndex')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $this->authorize('destroy', $article);
        $result = $this->service->deleteArticle($article);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('adminIndex')->with($result);
    }
}
