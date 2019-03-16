<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

/**
 * Corp\Role
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Corp\Permission[] $perms
 * @property-read \Illuminate\Database\Eloquent\Collection|\Corp\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Corp\Role query()
 * @mixin \Eloquent
 */
class Role extends Model
{
    public function users()
    {
        return $this->belongsToMany('Corp\User', 'role_user');
    }

    public function perms()
    {
        return $this->belongsToMany('Corp\Permission', 'permission_role');
    }

    public function hasPermission($name, $require = false)
    {
        if (is_array($name)) {
            foreach ($name as $permissionName) {
                $hasPermission = $this->hasPermission($permissionName);
                if ($hasPermission && !$require) {
                    return true;
                } elseif (!$hasPermission && $require) {
                    return false;
                }
            }
            return $require;
        } else {
            foreach ($this->perms as $permission) {
                if ($permission->name == $name) {
                    return true;
                }
            }
        }

        return false;
    }

    public function savePermissions($inputPermissions)
    {
        if (!empty($inputPermissions)) {
            $this->perms()->sync($inputPermissions);
        } else {
            $this->perms()->detach();
        }

        return true;
    }
}
