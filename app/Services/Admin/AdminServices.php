<?php

namespace Corp\Services\Admin;

use Menu;
use Gate;
use Config;
use Image;

abstract class AdminServices
{
    protected $p_rep;
    protected $s_rep;
    protected $a_rep;
    protected $m_rep;
    protected $c_rep;

    public function __construct()
    {

    }

    public function getMenu()
    {
        $mBuilder = Menu::make('adminMenu', function ($menu) {

            if (Gate::allows('VIEW_ADMIN_ARTICLES')) {
                $menu->add('Articles', ['route' => 'articlesIndex']);
            }

            if (Gate::allows('VIEW_ADMIN_PORTFOLIOS')) {
                $menu->add('Portfolios', ['route' => 'portfoliosIndex']);
            }

            if (Gate::allows('VIEW_ADMIN_MENU')) {
                $menu->add('Menu', ['route' => 'menus.index']);
            }

            if (Gate::allows('EDIT_USERS')) {
                $menu->add('Users', ['route' => 'users.index']);
                $menu->add('Permissions', ['route' => 'permissions.index']);
            }

            $menu->add('Logout', ['route' => 'logout']);
        });

        return $mBuilder;
    }

    public function imageConversation($image, $path = 'articles')
    {
        $str = str_random(8);
        $obj = new \stdClass;

        $obj->mini = $str . '_mini.jpg';
        $obj->max = $str . '_max.jpg';
        $obj->path = $str . '.jpg';

        $img = Image::make($image);

        $img->fit(Config::get('settings.' . $path . '_img')['path']['width'],
            Config::get('settings.' . $path . '_img')['path']['height'])->save(public_path() . '/' . config('settings.theme') . '/images/' . $path . '/' . $obj->path);
        $img->fit(Config::get('settings.' . $path . '_img')['max']['width'],
            Config::get('settings.' . $path . '_img')['max']['height'])->save(public_path() . '/' . config('settings.theme') . '/images/' . $path . '/' . $obj->max);
        $img->fit(Config::get('settings.' . $path . '_img')['mini']['width'],
            Config::get('settings.' . $path . '_img')['mini']['height'])->save(public_path() . '/' . config('settings.theme') . '/images/' . $path . '/' . $obj->mini);

        return json_encode($obj);
    }

    public function transliterate($string)
    {
        $str = mb_strtolower($string, 'UTF-8');

        $letter_array = [
            'a' => 'а',
            'b' => 'б',
            'v' => 'в',
            'g' => 'г,ґ',
            'd' => 'д',
            'e' => 'е,є,э',
            'jo' => 'ё',
            'zh' => 'ж',
            'z' => 'з',
            'i' => 'и,і',
            'ji' => 'ї',
            'j' => 'й',
            'k' => 'к',
            'l' => 'л',
            'm' => 'м',
            'n' => 'н',
            'o' => 'о',
            'p' => 'п',
            'r' => 'р',
            's' => 'с',
            't' => 'т',
            'u' => 'у',
            'f' => 'ф',
            'kh' => 'х',
            'ts' => 'ц',
            'ch' => 'ч',
            'sh' => 'ш',
            'shch' => 'щ',
            '' => 'ъ',
            'y' => 'ы',
            '' => 'ь',
            'yu' => 'ю',
            'ya' => 'я'
        ];

        foreach ($letter_array as $letter => $kyr) {
            $kyr = explode(',', $kyr);
            $str = str_replace($kyr, $letter, $str);
        }

        $str = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $str);
        $str = trim($str, '-');

        return $str;
    }
}
