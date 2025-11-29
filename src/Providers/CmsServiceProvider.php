<?php

namespace Molitor\Cms\Providers;

use Illuminate\Support\ServiceProvider;

class CmsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'cms');
    }

    public function register()
    {

    }
}
