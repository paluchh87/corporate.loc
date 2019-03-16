<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

/**
 * Corp\Comment
 *
 * @property-read \Corp\Article $article
 * @property-read \Corp\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Comment query()
 * @mixin \Eloquent
 */
class Comment extends Model
{

    protected $fillable = ['name','text','site','user_id','article_id','parent_id','email'];

    public function article() {
        return $this->belongsTo('Corp\Article');
    }

    public function user() {
        return $this->belongsTo('Corp\User');
    }
}
