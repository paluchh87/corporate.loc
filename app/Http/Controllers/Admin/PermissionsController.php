<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Permission;
use Illuminate\Http\Request;
use Corp\Services\Admin\PermissionServices;

class PermissionsController extends AdminController
{
    public function __construct(PermissionServices $permissionServices)
    {
        parent::__construct();

        $this->service = $permissionServices;
        $this->template = config('settings.theme') . '.admin.permissions';
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
        $this->title = "Менеджер прав пользователей";
        $roles = $this->service->getRoles();
        $permissions = $this->service->getPermissions();
        $this->content = view(config('settings.theme') . '.admin.permissions_content', compact('roles','permissions'))->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @throws
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('change', new Permission());
        $result = $this->service->changePermissions($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('permissions.index')->with($result);
    }
}
