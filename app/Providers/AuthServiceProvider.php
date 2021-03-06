<?php

namespace Corp\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Corp\Article;
use Corp\Permission;
use Corp\Menu;
use Corp\User;
use Corp\Portfolio;
use Corp\Policies\ArticlePolicy;
use Corp\Policies\PermissionPolicy;
use Corp\Policies\MenusPolicy;
use Corp\Policies\UserPolicy;
use Corp\Policies\PortfolioPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'Corp\Model' => 'Corp\Policies\ModelPolicy',
        Article::class => ArticlePolicy::class,
        Permission::class => PermissionPolicy::class,
        Menu::class => MenusPolicy::class,
        User::class => UserPolicy::class,
        Portfolio::class => PortfolioPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('VIEW_ADMIN', function (User $user) {
            return $user->canDo('VIEW_ADMIN', false);
        });

        Gate::define('VIEW_ADMIN_ARTICLES', function (User $user) {
            return $user->canDo('VIEW_ADMIN_ARTICLES', false);
        });

        Gate::define('VIEW_ADMIN_PORTFOLIOS', function (User $user) {
            return $user->canDo('VIEW_ADMIN_PORTFOLIOS', false);
        });

        Gate::define('EDIT_USERS', function (User $user) {
            return $user->canDo('EDIT_USERS', false);
        });

        Gate::define('VIEW_ADMIN_MENU', function (User $user) {
            return $user->canDo('VIEW_ADMIN_MENU', false);
        });
    }
}
