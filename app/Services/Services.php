<?php

namespace Corp\Services;

use Corp\Repositories\MenusRepository;
use Menu;

abstract class Services
{
    protected $p_rep;
    protected $s_rep;
    protected $a_rep;
    protected $m_rep;
    protected $c_rep;

    public function __construct(MenusRepository $m_rep)
    {
        $this->m_rep = $m_rep;
    }

    public function getMenu()
    {
        $menu = $this->m_rep->get();

//        foreach ($menu as $item) {
//
//            if ($item->parent == 0) {
//                $mo[] = ['title' => $item->title, 'path' => $item->path, 'parent' => $item->title];
//                $parent = $item->title;
//            } else {
//                $mo[] = ['title' => $item->title, 'path' => $item->path, 'parent' => $parent];
//            }
//        }
//
//        echo '<div class="menu classic">';
//        echo '<ul id="nav" class="menu">';
//        $t = 0;
//        foreach ($mo as $item) {
//
//            if ($item['parent'] != $item['title']) {
//                if ($t == 0) {
//                    echo ' <ul class="sub-menu">';
//                    $t = 1;
//                }
//            } else {
//                if ($t == 1) {
//                    echo '</ul>';
//                    $t = 0;
//                }
//            }
//            echo '<li>';
//            echo $item['title'];
//            echo '</li>';
//        }
//
//        echo '</ul>';
//        echo '</div>';
        if ($menu) {

            $mBuilder = Menu::make('MyNav', function ($m) use ($menu) {
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

            return $mBuilder;
        }
        return false;
    }
}
