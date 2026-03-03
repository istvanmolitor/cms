<?php

namespace Molitor\Cms\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Molitor\Cms\Http\Controllers\PageController;
use Molitor\Cms\Http\Controllers\PageGroupController;
use Molitor\Cms\Models\ContentRegion;
use Molitor\Cms\Models\Page;
use Molitor\Cms\Observers\ContentObserver;
use Molitor\Cms\View\Components\Content;
use Molitor\Cms\View\Components\ContentElement;
use Molitor\Cms\View\Components\ContentRegion as ContentRegionComponent;
use Molitor\Cms\View\Components\Menu;
use Molitor\Cms\View\Components\MenuItem;
use Molitor\Cms\Repositories\AuthorRepository;
use Molitor\Cms\Repositories\AuthorRepositoryInterface;
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
use Molitor\Cms\Repositories\PageGroupRepository;
use Molitor\Cms\Repositories\PageGroupRepositoryInterface;
use Molitor\Cms\Repositories\PageMetaRepository;
use Molitor\Cms\Repositories\PageMetaRepositoryInterface;
use Molitor\Cms\Repositories\PageRepository;
use Molitor\Cms\Repositories\PageRepositoryInterface;
use Molitor\Cms\Services\CmsMenuBuilder;
use Molitor\Cms\Services\LayoutService;

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

        // Register Blade components
        Blade::component('cms-content', Content::class);
        Blade::component('cms-content-element', ContentElement::class);
        Blade::component('cms-content-region', ContentRegionComponent::class);
        Blade::component('cms-menu', Menu::class);
        Blade::component('cms-menu-item', MenuItem::class);

        $contentObserver = new ContentObserver();

        Page::observe($contentObserver);
        ContentRegion::observe($contentObserver);
        $this->registerRouteMacros();
    }

    protected function registerRouteMacros()
    {
        Route::macro('cms', function () {
            Route::get('/', [PageController::class, 'homepage'])->name('cms.homepage');
            Route::get('/page', [PageController::class, 'index'])->name('cms.index');
            Route::get('/page/{slug}', [PageController::class, 'show'])->name('cms.page.show');
            Route::get('/page-group/{slug}', [PageGroupController::class, 'show'])->name('cms.page-group.show');
        });
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
        $this->app->bind(AuthorRepositoryInterface::class, AuthorRepository::class);
        $this->app->bind(PageGroupRepositoryInterface::class, PageGroupRepository::class);
        $this->app->bind(PageMetaRepositoryInterface::class, PageMetaRepository::class);
    }
}
