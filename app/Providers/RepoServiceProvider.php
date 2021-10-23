<?php

namespace App\Providers;


use App\Contracts\Repositories\ActionLogRepoContract;
use App\Contracts\Repositories\RoleRepoContract;
use App\Contracts\Repositories\UsersRepoContract;
use App\Contracts\Repositories\CalendarEventRepoContract;
use App\Repositories\ActionLogRepo;
use App\Repositories\RoleRepo;
use App\Repositories\UsersRepo;
use App\Repositories\CalendarEventRepo;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UsersRepoContract::class, UsersRepo::class);
        $this->app->bind(ActionLogRepoContract::class, ActionLogRepo::class);
        $this->app->bind(RoleRepoContract::class, RoleRepo::class);
        $this->app->bind(CalendarEventRepoContract::class, CalendarEventRepo::class);
    }
}
