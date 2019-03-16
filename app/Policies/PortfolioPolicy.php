<?php

namespace Corp\Policies;

use Corp\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PortfolioPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function save(User $user) {
        return $user->canDo('ADD_PORTFOLIOS');
    }

    public function edit(User $user) {
        return $user->canDo('UPDATE_PORTFOLIOS');
    }

    public function destroy(User $user) {
        return $user->canDo('DELETE_PORTFOLIOS');
    }
}
