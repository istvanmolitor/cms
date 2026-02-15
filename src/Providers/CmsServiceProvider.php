<?php

namespace Molitor\Cms\Providers;

use Illuminate\Support\ServiceProvider;
use Molitor\Cms\Models\ContentRegion;
use Molitor\Cms\Models\Page;
use Molitor\Cms\Observers\ContentObserver;
use Molitor\Cms\Repositories\ContentElementTypeRepository;
use Molitor\Cms\Repositories\ContentElementTypeRepositoryInterface;
use Molitor\Cms\Repositories\ContentElementRepository;
use Molitor\Cms\Repositories\ContentElementRepositoryInterface;
use Molitor\Cms\Repositories\ContentRegionRepository;
use Molitor\Cms\Repositories\ContentRegionRepositoryInterface;
use Molitor\Cms\Repositories\ContentRepository;
use Molitor\Cms\Repositories\ContentRepositoryInterface;
use Molitor\Cms\Repositories\MenuItemRepository;
use Molitor\Cms\Repositories\MenuItemRepositoryInterface;
use Molitor\Cms\Repositories\MenuRepository;
use Molitor\Cms\Repositories\MenuRepositoryInterface;
use Molitor\Cms\Repositories\PageRepository;
use Molitor\Cms\Repositories\PageRepositoryInterface;
use Molitor\Cms\Services\CmsMenuBuilder;
use Molitor\Cms\Services\ContentHandler;
use Molitor\Cms\Services\ContentElementTypes\CodeElementType;
use Molitor\Cms\Services\ContentElementTypes\HeadingElementType;
use Molitor\Cms\Services\ContentElementTypes\ImageElementType;
use Molitor\Cms\Services\ContentElementTypes\ListElementType;
use Molitor\Cms\Services\ContentElementTypes\QuoteElementType;
use Molitor\Cms\Services\ContentElementTypes\TextElementType;
use Molitor\Cms\Services\ContentElementTypes\VideoElementType;
use Molitor\Menu\Services\MenuManager;

class CmsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'cms');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'cms');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        $this->publishes([
            __DIR__ . '/../config/cms.php' => config_path('cms.php'),
        ], 'cms-config');

        $this->mergeConfigFrom(
            __DIR__ . '/../config/cms.php', 'cms'
        );

        $contentObserver = new ContentObserver();

        Page::observe($contentObserver);
        ContentRegion::observe($contentObserver);
    }

    public function register()
    {
        $this->app->bind(ContentRepositoryInterface::class, ContentRepository::class);
        $this->app->bind(ContentElementRepositoryInterface::class, ContentElementRepository::class);
        $this->app->bind(ContentElementTypeRepositoryInterface::class, ContentElementTypeRepository::class);
        $this->app->bind(ContentRegionRepositoryInterface::class, ContentRegionRepository::class);
        $this->app->bind(PageRepositoryInterface::class, PageRepository::class);
        $this->app->bind(MenuRepositoryInterface::class, MenuRepository::class);
        $this->app->bind(MenuItemRepositoryInterface::class, MenuItemRepository::class);
    }
}
