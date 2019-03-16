<?php

namespace Corp\Repositories;

use Corp\Role;

class RolesRepository extends Repository
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function getRolesInArray()
    {
        $result = $this->model->select(['id', 'name'])->get()->toArray();

        return $result;
    }
}
