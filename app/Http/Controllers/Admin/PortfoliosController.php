<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Http\Requests\PortfolioRequest;
use Corp\Portfolio;
use Corp\Services\Admin\PortfoliosServices;

class PortfoliosController extends AdminController
{
    public function __construct(PortfoliosServices $portfolioServices)
    {
        parent::__construct();

        $this->service = $portfolioServices;
        $this->template = config('settings.theme') . '.admin.portfolios';
    }

    /**
     * Display a listing of the resource.
     *
     * @throws
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('VIEW_ADMIN_PORTFOLIOS');

        $this->title = 'Портфолио';
        $portfolios = $this->service->getPortfolios();
        $this->content = view(config('settings.theme') . '.admin.portfolios_content',compact('portfolios'))->render();

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
        $this->authorize('save', new Portfolio());
        $this->title = "Добавить новую работу";
        $filters=$this->service->getFilters();
        $this->content = view(config('settings.theme') . '.admin.portfolios_create_content', compact('filters'))->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @throws
     * @param  PortfolioRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PortfolioRequest $request)
    {
        $portfolio=new Portfolio();
        $this->authorize('save', $portfolio);
        $result = $this->service->addPortfolio($request, $portfolio);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('adminIndex')->with($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @throws
     * @param  Portfolio $portfolio
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Portfolio $portfolio)
    {
        $this->authorize('edit', $portfolio);
        $portfolio->img = json_decode($portfolio->img);
        $filters=$this->service->getFilters();
        $this->title = 'Реадактирование материала - ' . $portfolio->title;
        $this->content = view(config('settings.theme') . '.admin.portfolios_create_content', compact('portfolio', 'filters'))->render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws
     * @param  PortfolioRequest $request
     * @param  Portfolio $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(PortfolioRequest $request, Portfolio $portfolio)
    {
        $this->authorize('edit', $portfolio);
        $result = $this->service->updatePortfolio($request, $portfolio);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('adminIndex')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws
     * @param  Portfolio $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        $this->authorize('destroy', $portfolio);
        $result = $this->service->deletePortfolio($portfolio);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('adminIndex')->with($result);
    }
}
