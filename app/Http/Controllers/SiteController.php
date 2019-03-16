<?php

namespace Corp\Http\Controllers;

use Corp\Menu;
use Corp\Services\Services;

class SiteController extends Controller
{
    protected $keywords;
    protected $meta_desc;
    protected $title;

    protected $template;
    protected $vars = [];
    protected $contentRightBar = false;
    protected $contentLeftBar = false;
    protected $bar = 'no';

    /**
     * @var Services
     */
    protected $service;

    public function __construct()
    {

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    protected function renderOutput()
    {
        $menu = $this->service->getMenu();
        $navigation = view(config('settings.theme') . '.navigation', compact('menu'))->render();
        $this->vars = array_add($this->vars, 'navigation', $navigation);

        $footer = view(config('settings.theme') . '.footer')->render();
        $this->vars = array_add($this->vars, 'footer', $footer);

        $this->vars = array_add($this->vars, 'keywords', $this->keywords);
        $this->vars = array_add($this->vars, 'meta_desc', $this->meta_desc);
        $this->vars = array_add($this->vars, 'title', $this->title);

        $this->vars = array_add($this->vars, 'bar', $this->bar);

        if ($this->contentRightBar) {
            $rightBar = view(config('settings.theme') . '.rightBar')
                ->with('content_rightBar', $this->contentRightBar)
                ->render();
            $this->vars = array_add($this->vars, 'rightBar', $rightBar);
        }

        if ($this->contentLeftBar) {
            $leftBar = view(config('settings.theme') . '.leftBar')
                ->with('content_leftBar', $this->contentLeftBar)
                ->render();
            $this->vars = array_add($this->vars, 'leftBar', $leftBar);
        }

        return view($this->template)->with($this->vars);
    }
}
