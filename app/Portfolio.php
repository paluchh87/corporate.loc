<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

/**
 * Corp\Portfolio
 *
 * @property-read \Corp\Filter $filter
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Portfolio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Portfolio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Portfolio query()
 * @mixin \Eloquent
 */
class Portfolio extends Model
{
    protected $fillable = ['title','img','alias','text','keywords','meta_desc', 'customer', 'filter_alias'];

    public function filter() {
        return $this->belongsTo('Corp\Filter','filter_alias','alias');
    }
}
