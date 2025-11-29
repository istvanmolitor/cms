<?php

namespace Molitor\Cms\Providers;

use Illuminate\Support\ServiceProvider;
use Molitor\Cms\Repositories\ContentElementRepository;
use Molitor\Cms\Repositories\ContentElementRepositoryInterface;
use Molitor\Cms\Repositories\ContentRepository;
use Molitor\Cms\Repositories\ContentRepositoryInterface;
use Molitor\Cms\Repositories\PageRepository;
use Molitor\Cms\Repositories\PageRepositoryInterface;

class CmsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'cms');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'cms');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');

        $this->publishes([
            __DIR__ . '/../../config/cms.php' => config_path('cms.php'),
        ], 'cms-config');

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/cms.php', 'cms'
        );
    }

    public function register()
    {
        $this->app->bind(ContentRepositoryInterface::class, ContentRepository::class);
        $this->app->bind(ContentElementRepositoryInterface::class, ContentElementRepository::class);
        $this->app->bind(PageRepositoryInterface::class, PageRepository::class);
    }
}
