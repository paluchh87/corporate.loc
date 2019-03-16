<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

/**
 * Corp\Menu
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Menu query()
 * @mixin \Eloquent
 */
class Menu extends Model
{
    protected $fillable = [
        'title',
        'path',
        'parent'
    ];
}
