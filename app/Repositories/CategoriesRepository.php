<?php

namespace Corp\Repositories;

use Corp\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoriesRepository extends Repository
{
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getCategoryIdByAlias($alias)
    {
        $result=$this->model->select('id')->where('alias', $alias)->first()->id;

        return $result;
    }

    public function getCategories()
    {
        $result = $this->model->select(['title', 'alias', 'parent_id', 'id'])->get();

        return $result;
    }

    public function getCategoryTitleWhere(Collection $category, $column, $value)
    {
        $result = $category->where($column, $value)->first()->title;

        return $result;
    }
}
