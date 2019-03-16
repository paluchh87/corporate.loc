<?php

namespace Corp\Services;

use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\SlidersRepository;

class IndexServices extends Services
{
    public function __construct(SlidersRepository $s_rep, PortfoliosRepository $p_rep, ArticlesRepository $a_rep)
    {
        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));

        $this->s_rep = $s_rep;
        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;
    }

    public function getPortfolios($take)
    {
        $portfolio = $this->p_rep->get('*', $take, false, false, 'id');

        return $portfolio;
    }

    public function getSliders($path)
    {
        $sliders = $this->s_rep->get();

        if (!$sliders) {
            return false;
        }

        foreach ($sliders as $item) {
            $item->img = $path . '/' . $item->img;
        }

        return $sliders;
    }

    public function getArticles($take)
    {
        $articles = $this->a_rep->get(['title', 'created_at', 'img', 'alias'], $take, false, false, 'id');

        return $articles;
    }
}
