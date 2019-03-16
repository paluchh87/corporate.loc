<?php

namespace Corp\Services;

use Corp\Repositories\PortfoliosRepository;

class PortfolioServices extends Services
{
    public function __construct(PortfoliosRepository $p_rep)
    {
        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));

        $this->p_rep = $p_rep;
    }

    public function getPortfolios($take = false, $paginate = true)
    {
        $portfolios = $this->p_rep->get('*', $take, $paginate, false, 'id');
        if ($portfolios) {
            $portfolios->load('filter');
        }

        return $portfolios;
    }

    public function getOnePortfolio($alias)
    {
        $portfolio = $this->p_rep->oneByAlias($alias);

        return $portfolio;
    }
}
