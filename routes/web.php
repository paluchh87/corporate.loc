<?php

Route::resource('/', 'IndexController', ['only' => ['index'], 'names' => ['index' => 'home']]);

Route::resource('portfolios', 'PortfolioController', ['only' => ['index', 'show'], 'parameters' => ['portfolios' => 'alias']]);

Route::resource('articles', 'ArticlesController', ['only' => ['index', 'show'], 'parameters' => ['articles' => 'alias']]);

Route::get('articles/cat/{cat_alias?}', 'ArticlesController@index')->name('articlesCat')->where('cat_alias', '[\w-]+');

Route::resource('comment', 'CommentController', ['only' => ['store']]);

Route::get('contacts', 'ContactsController@index')->name('contacts');

//Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

//admin
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    //admin
    Route::get('/', ['uses' => 'Admin\IndexController@index', 'as' => 'adminIndex']);

    Route::resource('/articles', 'Admin\ArticlesController', [
        'parameters' => ['articles' => 'articles'],
        'except' => ['show'],
        //'parameters' => ['articles' => 'alias'],
        'names' => [
            'index' => 'articlesIndex',
            'destroy' => 'articlesDestroy',
            'create' => 'articlesCreate',
            'update' => 'articlesUpdate',
            'store' => 'articlesStore',
            //'show' => 'articlesShowAdmin',
            'edit' => 'articlesEdit'
        ]
    ]);
    Route::resource('/permissions', 'Admin\PermissionsController',['only'=>['index','store']]);
    Route::resource('/menus', 'Admin\MenusController',['only' => ['index', 'destroy']]);
    Route::resource('/users', 'Admin\UsersController',['except' => ['show']]);

    Route::resource('/portfolios', 'Admin\PortfoliosController', [
        'parameters' => ['portfolios' => 'portfolios'],
        'except' => ['show'],
        'names' => [
            'index' => 'portfoliosIndex',
            'destroy' => 'portfoliosDestroy',
            'create' => 'portfoliosCreate',
            'update' => 'portfoliosUpdate',
            'store' => 'portfoliosStore',
            'edit' => 'portfoliosEdit'
        ]
    ]);

});


