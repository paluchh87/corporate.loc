<?php

namespace Corp\Services\Admin;

use Corp\Repositories\UsersRepository;
use Corp\Repositories\RolesRepository;
use Corp\User;
use Corp\Http\Requests\UserRequest;

class UserServices extends AdminServices
{
    protected $us_rep;
    protected $rol_rep;

    public function __construct(RolesRepository $rol_rep, UsersRepository $us_rep)
    {
        parent::__construct();

        $this->us_rep = $us_rep;
        $this->rol_rep = $rol_rep;
    }

    public function getUsers()
    {
        $users = $this->us_rep->get();

        return $users;
    }

    public function getRoles()
    {
        $data = [];
        $roles = $this->rol_rep->getRolesInArray();
        foreach ($roles as $role) {
            $data[$role['id']] = $role['name'];
        }

        return $data;
    }

    public function addUser(UserRequest $request, User $userModel)
    {
        $data = $request->all();

        $user = $userModel->create([
            'name' => $data['name'],
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if ($user) {
            $user->roles()->attach($data['role_id']);
        }

        return ['status' => 'User added'];
    }

    public function updateUser(UserRequest $request, User $user)
    {
        $data = $request->all();

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->fill($data)->update();
        $user->roles()->sync([$data['role_id']]);

        return ['status' => 'User updated'];
    }

    /**
     * @param User $user
     * @return array
     * @throws \Exception
     */
    public function deleteUser(User $user)
    {
        $user->roles()->detach();

        if ($user->delete()) {
            return ['status' => 'User deleted'];
        }
        return ['error' => 'ERROR "User deleted"'];
    }
}
