<?php

namespace Hrm\MenuBuilder\Providers;

use Hrm\MenuBuilder\Component\TestComponent;
use Livewire\Livewire;
use Hrm\MenuBuilder\Facades\HrmMenu;
use Illuminate\Support\ServiceProvider;
use Hrm\MenuBuilder\Controllers\HrmMenuBuilderController;

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
        ],'views');
        $this->publishes([
            __DIR__.'/../assets'=>public_path('vendor/hrm')
        ],'public');
        $this->publishes([
            __DIR__.'/../migrations'=>database_path('migrations')
        ],'migrations');

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
