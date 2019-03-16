<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Services\Admin\UserServices;
use Corp\Http\Requests\UserRequest;
use Corp\User;

class UsersController extends AdminController
{
    public function __construct(UserServices $userServices)
    {
        parent::__construct();

        $this->service = $userServices;
        $this->template = config('settings.theme') . '.admin.users';
    }

    /**
     * Display a listing of the resource.
     *
     * @throws
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('EDIT_USERS');

        $users = $this->service->getUsers();
        $this->content = view(config('settings.theme') . '.admin.users_content', compact('users'))->render();

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->title = 'Новый пользователь';
        $roles = $this->service->getRoles();
        $this->content = view(config('settings.theme') . '.admin.users_create_content', compact('roles'))->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @throws
     * @param  UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $this->authorize('create', $user);
        $result = $this->service->addUser($request, $user);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('adminIndex')->with($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @throws
     * @param  User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $this->authorize('edit', $user);
        $this->title = 'Редактирование пользователя - ' . $user->name;
        $roles = $this->service->getRoles();
        $this->content = view(config('settings.theme') . '.admin.users_create_content',
            compact('roles', 'user'))->render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws
     * @param  UserRequest $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('edit', $user);
        $result = $this->service->updateUser($request, $user);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('adminIndex')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('edit', $user);
        $result = $this->service->deleteUser($user);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('adminIndex')->with($result);
    }
}
