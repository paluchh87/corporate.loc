<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Services\Admin\MenuServices;
use Corp\Http\Requests\MenusRequest;

class MenusController extends AdminController
{
    public function __construct(MenuServices $menuServices)
    {
        parent::__construct();

        $this->service = $menuServices;
        $this->template = config('settings.theme') . '.admin.menus';
    }

    /**
     * Display a listing of the resource.
     *
     * @throws
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('VIEW_ADMIN_MENU');
        $menus = $this->service->getMenus();
        $this->content = view(config('settings.theme') . '.admin.menus_content', compact('menus'))->render();

        return $this->renderOutput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws
     * @param  \Corp\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(\Corp\Menu $menu)
    {
        $this->authorize('save', $menu);
        $result = $this->service->deleteMenu($menu);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('adminIndex')->with($result);
    }
}
