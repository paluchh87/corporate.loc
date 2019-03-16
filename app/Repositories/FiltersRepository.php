<?php

namespace Corp\Repositories;

use Corp\Filter;

class FiltersRepository extends Repository
{
    public function __construct(Filter $slider)
    {
        $this->model = $slider;
    }
}
