<?php

namespace Corp\Repositories;

use Corp\Portfolio;

class PortfoliosRepository extends Repository
{
    public function __construct(Portfolio $portfolio)
    {
        $this->model = $portfolio;
    }

    public function oneByAlias($alias, $attr =[])
    {
        $portfolio = parent::oneByAlias($alias, $attr);

        if ($portfolio && $portfolio->img) {
            $portfolio->img = json_decode($portfolio->img);
        }

        return $portfolio;
    }
}
