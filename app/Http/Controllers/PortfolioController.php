<?php

namespace Corp\Http\Controllers;

use Corp\Services\PortfolioServices;

class PortfolioController extends SiteController
{
    public function __construct(PortfolioServices $portfolioServices)
    {
        parent::__construct();

        $this->service = $portfolioServices;
        $this->template = config('settings.theme') . '.portfolios';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index()
    {
        $this->title = 'Портфолио';
        $this->keywords = 'Портфолио';
        $this->meta_desc = 'Портфолио';

        $portfolios = $this->service->getPortfolios();
        $content = view(config('settings.theme') . '.portfolios_content', compact('portfolios'))->render();
        $this->vars = array_add($this->vars, 'content', $content);

        return $this->renderOutput();
    }

    /**
     * @param $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function show($alias)
    {
        $portfolio = $this->service->getOnePortfolio($alias);
        $portfolios = $this->service->getPortfolios(config('settings.other_portfolios'), false);

        $this->title = $portfolio->title;
        $this->keywords = $portfolio->keywords;
        $this->meta_desc = $portfolio->meta_desc;

        $content = view(config('settings.theme') . '.portfolio_content',compact('portfolio', 'portfolios'))->render();
        $this->vars = array_add($this->vars, 'content', $content);

        return $this->renderOutput();
    }
}
