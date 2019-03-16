<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Services\Services;
use Corp\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * @var Services
     */
    protected $service;
    protected $template;
    protected $content = false;
    protected $title;
    protected $vars;

    public function __construct()
    {

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function renderOutput()
    {
        $this->vars = array_add($this->vars, 'title', $this->title);

        $menu = $this->service->getMenu();
        $navigation = view(config('settings.theme') . '.admin.navigation',compact('menu'))->render();
        $this->vars = array_add($this->vars, 'navigation', $navigation);

        if ($this->content) {
            $this->vars = array_add($this->vars, 'content', $this->content);
        }

        $footer = view(config('settings.theme') . '.admin.footer')->render();
        $this->vars = array_add($this->vars, 'footer', $footer);

        return view($this->template)->with($this->vars);
    }
}
