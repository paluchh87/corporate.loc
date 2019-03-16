<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

/**
 * Corp\Article
 *
 * @property-read \Corp\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\Corp\Comment[] $comments
 * @property-read \Corp\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Article query()
 * @mixin \Eloquent
 */
class Article extends Model
{
    protected $fillable = ['title', 'img', 'alias', 'text', 'desc', 'keywords', 'meta_desc', 'category_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
