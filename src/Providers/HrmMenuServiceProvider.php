<?php

namespace Hrm\MenuBuilder\Providers;

use Illuminate\Support\ServiceProvider;
use Hrm\MenuBuilder\Controllers\HrmMenuBuilderController;
use Hrm\MenuBuilder\Facades\HrmMenu;

class HrmMenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        // include __DIR__.'/routes.php';
        $this->app->bind('hrm-menu', function(){
            return new HrmMenu();
        });
        $this->loadViewsFrom(__DIR__.'/../views','hrmmenu');
        $this->app->make(HrmMenuBuilderController::class);

        $this->loadMigrationsFrom(__DIR__.'/../migrations');
        $this->publishes([
            __DIR__.'/../views'=>resource_path('views/vendor/hrm-menu', 'view')
        ]);
        $this->publishes([
            __DIR__.'/../assets'=>public_path('vendor/hrm')
        ],'public');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadRoutesFrom(__DIR__.'/../routes.php');

    }
}
