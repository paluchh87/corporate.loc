<?php

namespace Corp\Repositories;

use Corp\User;

class UsersRepository extends Repository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }
}
