<?php

return [
    'slider_path' => 'slider-flex',
    'home_port_count' => 5,
    'home_articles_count' => 5,
    'theme' => env('THEME','white'),
    'paginate' => 2,
    'recent_comments' => 3,
    'recent_portfolios' => 3,
    'other_portfolios' => 6,
    'articles_img' => [
        'max' => ['width' => 816, 'height' => 282],
        'mini' => ['width' => 55, 'height' => 55],
        'path' => ['width' => 1024, 'height' => 768]
    ],
    'portfolios_img' => [
        'max' => ['width' => 770, 'height' => 368],
        'mini' => ['width' => 175, 'height' => 175],
        'path' => ['width' => 1024, 'height' => 768]
    ],
];
