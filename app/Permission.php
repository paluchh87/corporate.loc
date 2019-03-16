<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

/**
 * Corp\Permission
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Corp\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Permission query()
 * @mixin \Eloquent
 */
class Permission extends Model
{
    public function roles() {
        return $this->belongsToMany('Corp\Role','permission_role');
    }
}
