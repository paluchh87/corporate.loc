<?php

namespace Corp\Services\Admin;

use Corp\Repositories\ArticlesRepository;
use Corp\Http\Requests\ArticleRequest;
use Corp\Article;
use Corp\Repositories\CategoriesRepository;

class ArticleServices extends AdminServices
{
    protected $cat_rep;

    public function __construct(ArticlesRepository $a_rep, CategoriesRepository $cat_rep)
    {
        parent::__construct();

        $this->a_rep = $a_rep;
        $this->cat_rep = $cat_rep;
    }

    public function getArticles()
    {
        $articles=$this->a_rep->get();
        if ($articles) {
            $articles->load('category');
        }

        return $articles;
    }

    public function getCategories()
    {
        $lists = [];
        $categories = $this->cat_rep->getCategories();

        foreach ($categories as $category) {
            if ($category->parent_id == 0) {
                $lists[$category->title] = [];
            } else {
                $lists[$this->cat_rep->getCategoryTitleWhere($categories, 'id', $category->parent_id)][$category->id] = $category->title;
            }
        }

        return $lists;
    }

    public function addArticle(ArticleRequest $request, Article $article)
    {
        $data = $request->except('_token', 'image');

        if (empty($data)) {
            return ['error' => 'No data'];
        }

        if (empty($data['alias'])) {
            $data['alias'] = $this->transliterate($data['title']);
        }

        if ($this->a_rep->oneByAlias($data['alias'], false)) {
            $request->merge(['alias' => $data['alias']]);
            $request->flash();

            return ['error' => 'ERROR "This Alias is already in use"'];
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($image->isValid()) {
                $data['img'] = $this->imageConversation($image, 'articles');
            }
        }

        $article->fill($data);

        if ($request->user()->articles()->save($article)) {
            return ['status' => 'Article added'];
        }

        return ['error' => 'ERROR "Article added"'];
    }

    public function updateArticle(ArticleRequest $request, Article $article)
    {
        $data = $request->except('_token', 'image', '_method');

        if (empty($data)) {
            return ['error' => 'No data'];
        }

        if (empty($data['alias'])) {
            $data['alias'] = $this->transliterate($data['title']);
        }

        $result = $this->a_rep->oneByAlias($data['alias'], false);
        if (isset($result->id) && ($result->id != $article->id)) {
            $request->merge(['alias' => $data['alias']]);
            $request->flash();

            return ['error' => 'ERROR "This Alias is already in use"'];
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($image->isValid()) {
                $data['img'] = $this->imageConversation($image,'articles');
            }
        }

        $article->fill($data);

        if ($article->update()) {
            return ['status' => 'Article updated'];
        }

        return ['error' => 'ERROR "Article updated"'];
    }

    public function deleteArticle(Article $article)
    {
        $article->comments()->delete();
        if ($article->delete()) {
            return ['status' => 'Article deleted'];
        }

        return ['error' => 'ERROR "Article deleted"'];
    }
}
