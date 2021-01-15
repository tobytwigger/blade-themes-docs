<?php

namespace App\Providers;

use App\Services\DocSchema\Factory\ComponentSchemaFactory;
use App\Services\DocSchema\Parser\ComponentAttributeParser;
use App\Services\DocSchema\Parser\ComponentDescriptionParser;
use App\Services\DocSchema\Parser\ComponentExampleParser;
use App\Services\DocSchema\Parser\ComponentNameParser;
use App\Services\DocSchema\Parser\ComponentSlotParser;
use App\Services\DocSchema\Parser\ComponentTipsParser;
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
        $this->app->bind(ComponentSchemaFactory::class, function($app) {
            return new ComponentSchemaFactory(
                $app->make(ComponentNameParser::class),
                $app->make(ComponentDescriptionParser::class),
                $app->make(ComponentTipsParser::class),
                $app->make(ComponentAttributeParser::class),
                $app->make(ComponentSlotParser::class),
                $app->make(ComponentExampleParser::class)
            );
        });
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
