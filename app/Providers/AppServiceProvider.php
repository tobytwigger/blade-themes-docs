<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Twigger\Blade\ThemeServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        ThemeServiceProvider::useTheme(request()->get('theme', 'material'));
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
