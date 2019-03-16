<?php

namespace Corp\Services\Admin;

use Corp\Http\Requests\PortfolioRequest;
use Corp\Portfolio;
use Corp\Repositories\FiltersRepository;
use Corp\Repositories\PortfoliosRepository;

class PortfoliosServices extends AdminServices
{
    protected $f_rep;

    public function __construct(PortfoliosRepository $p_rep, FiltersRepository $f_rep)
    {
        parent::__construct();

        $this->p_rep = $p_rep;
        $this->f_rep = $f_rep;
    }

    public function getPortfolios()
    {
        return $this->p_rep->get();
    }

    public function getFilters()
    {
        $lists = [];
        $filters = $this->f_rep->get(['alias', 'title']);
        foreach ($filters as $filter) {
            $lists[$filter->alias] = $filter->title;
        }

        return $lists;
    }

    public function addPortfolio(PortfolioRequest $request, Portfolio $portfolio)
    {
        $data = $request->except('_token', 'image');

        if (empty($data)) {
            return ['error' => 'No data'];
        }

        if (empty($data['alias'])) {
            $data['alias'] = $this->transliterate($data['title']);
        }

        if ($this->p_rep->oneByAlias($data['alias'], false)) {
            $request->merge(['alias' => $data['alias']]);
            $request->flash();

            return ['error' => 'ERROR "This Alias is already in use"'];
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($image->isValid()) {
                $data['img'] = $this->imageConversation($image, 'portfolios');
            }
        }

        $portfolio->fill($data);

        if ($portfolio->save()) {
            return ['status' => 'Portfolio added'];
        }

        return ['error' => 'ERROR "Portfolio added"'];
    }

    public function updatePortfolio(PortfolioRequest $request, Portfolio $portfolio)
    {
        $data = $request->except('_token', 'image', '_method');

        if (empty($data)) {
            return ['error' => 'No data'];
        }

        if (empty($data['alias'])) {
            $data['alias'] = $this->transliterate($data['title']);
        }

        $result = $this->p_rep->oneByAlias($data['alias'], false);
        if (isset($result->id) && ($result->id != $portfolio->id)) {
            $request->merge(['alias' => $data['alias']]);
            $request->flash();

            return ['error' => 'ERROR "This Alias is already in use"'];
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($image->isValid()) {
                $data['img'] = $this->imageConversation($image, 'portfolios');
            }
        }

        $portfolio->fill($data);

        if ($portfolio->update()) {
            return ['status' => 'Portfolio updated'];
        }

        return ['error' => 'ERROR "Portfolio updated"'];
    }

    public function deletePortfolio(Portfolio $portfolio)
    {
        if ($portfolio->delete()) {
            return ['status' => 'Portfolio deleted'];
        }

        return ['error' => 'ERROR "Portfolio deleted"'];
    }
}
