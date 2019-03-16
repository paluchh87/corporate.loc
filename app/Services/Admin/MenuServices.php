<?php

namespace Corp\Services\Admin;

use Corp\Repositories\MenusRepository;
use Menu;

class MenuServices extends AdminServices
{
    public function __construct(MenusRepository $m_rep)
    {
        parent::__construct();

        $this->m_rep = $m_rep;
    }

    public function getMenus()
    {
        $menu = $this->m_rep->get();

        if ($menu->isEmpty()) {
            return false;
        }

        return Menu::make('forMenuPart', function ($m) use ($menu) {

            foreach ($menu as $item) {
                if ($item->parent == 0) {
                    $m->add($item->title, $item->path)->id($item->id);
                } else {
                    if ($m->find($item->parent)) {
                        $m->find($item->parent)->add($item->title, $item->path)->id($item->id);
                    }
                }
            }
        });
    }

    /**
     * @param \Corp\Menu $menu
     * @return array
     * @throws \Exception
     */
    public function deleteMenu(\Corp\Menu $menu)
    {
        \Corp\Menu::where('parent', $menu->id)->delete();

        if ($menu->delete()) {
            return ['status' => 'URL deleted'];
        }

        return ['error' => 'ERROR "URL deleted"'];
    }
}
