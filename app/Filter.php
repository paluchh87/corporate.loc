<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

/**
 * Corp\Filter
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Filter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Filter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Filter query()
 * @mixin \Eloquent
 */
class Filter extends Model
{
    protected $fillable = ['title', 'alias'];
}
