<?php

namespace Corp\Http\Controllers;

use Corp\Services\IndexServices;

class IndexController extends SiteController
{
    /**
     * IndexController constructor.
     *
     * @param IndexServices $indexServices
     */
    public function __construct(IndexServices $indexServices)
    {
        parent::__construct();

        $this->service = $indexServices;
        $this->bar = 'right';
        $this->template = config('settings.theme') . '.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @throws
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->keywords = 'Home Page';
        $this->meta_desc = 'Home Page';
        $this->title = 'Home Page';

        $portfolios = $this->service->getPortfolios(config('settings.home_port_count'));
        $content = view(config('settings.theme') . '.content',compact('portfolios'))->render();
        $this->vars = array_add($this->vars, 'content', $content);

        $sliderItems = $this->service->getSliders(config('settings.slider_path'));
        $sliders = view(config('settings.theme') . '.slider')->with('sliders', $sliderItems)->render();
        $this->vars = array_add($this->vars, 'sliders', $sliders);

        $articles = $this->service->getArticles(config('settings.home_articles_count'));
        $this->contentRightBar = view(config('settings.theme') . '.indexBar', compact('articles'))->render();

        return $this->renderOutput();
    }
}
