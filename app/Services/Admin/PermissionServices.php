<?php

namespace Corp\Services\Admin;

use Corp\Repositories\PermissionsRepository;
use Corp\Repositories\RolesRepository;
use Illuminate\Http\Request;

class PermissionServices extends AdminServices
{
    protected $per_rep;
    protected $rol_rep;

    public function __construct(PermissionsRepository $per_rep, RolesRepository $rol_rep)
    {
        parent::__construct();

        $this->per_rep = $per_rep;
        $this->rol_rep = $rol_rep;
    }

    public function getRoles()
    {
        $roles = $this->rol_rep->get();
        if ($roles) {
            $roles->load('perms');
        }

        return $roles;
    }

    public function getPermissions()
    {
        $permissions = $this->per_rep->get();

        return $permissions;
    }

    public function changePermissions(Request $request)
    {
        $data = $request->except('_token');
        $roles = $this->getRoles();

        foreach ($roles as $role) {
            if (isset($data[$role->id])) {
                $role->savePermissions($data[$role->id]);
            } else {
                $role->savePermissions([]);
            }
        }

        return ['status' => 'Permissions updated'];
    }
}
