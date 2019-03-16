<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

/**
 * Corp\Category
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Corp\Article[] $articles
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Category query()
 * @mixin \Eloquent
 */
class Category extends Model
{
    public function articles() {
        return $this->hasMany('Corp\Article');
    }
}
