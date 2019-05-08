<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Custom\Settings;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->share('settings', Settings::getInstance());
        \Schema::enableForeignKeyConstraints();
    }
}
