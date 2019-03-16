<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Services\Admin\IndexServices;

class IndexController extends AdminController
{
    public function __construct(IndexServices $indexServices)
    {
        parent::__construct();

        $this->service = $indexServices;
        $this->template = config('settings.theme') . '.admin.index';
    }

    public function index()
    {
        $this->authorize('VIEW_ADMIN');
        $this->title = 'Панель администратора';

        return $this->renderOutput();
    }
}
