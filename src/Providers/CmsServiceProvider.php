<?php

namespace Molitor\Cms\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Molitor\Cms\Models\ContentRegion;
use Molitor\Cms\Models\Page;
use Molitor\Cms\Observers\ContentObserver;
use Molitor\Cms\Repositories\AuthorRepository;
use Molitor\Cms\Repositories\AuthorRepositoryInterface;
use Molitor\Cms\Repositories\ContentElementRepository;
use Molitor\Cms\Repositories\ContentElementRepositoryInterface;
use Molitor\Cms\Repositories\ContentElementTypeRepository;
use Molitor\Cms\Repositories\ContentElementTypeRepositoryInterface;
use Molitor\Cms\Repositories\ContentRegionRepository;
use Molitor\Cms\Repositories\ContentRegionRepositoryInterface;
use Molitor\Cms\Repositories\ContentRepository;
use Molitor\Cms\Repositories\ContentRepositoryInterface;
use Molitor\Cms\Repositories\MenuItemRepository;
use Molitor\Cms\Repositories\MenuItemRepositoryInterface;
use Molitor\Cms\Repositories\MenuRepository;
use Molitor\Cms\Repositories\MenuRepositoryInterface;
use Molitor\Cms\Repositories\PageMetaRepository;
use Molitor\Cms\Repositories\PageMetaRepositoryInterface;
use Molitor\Cms\Repositories\PageRepository;
use Molitor\Cms\Repositories\PageRepositoryInterface;
use Molitor\Cms\Repositories\PostGroupRepository;
use Molitor\Cms\Repositories\PostGroupRepositoryInterface;
use Molitor\Cms\Repositories\PageTypeRepository;
use Molitor\Cms\Repositories\PageTypeRepositoryInterface;
use Molitor\Cms\Repositories\PostTypeRepository;
use Molitor\Cms\Repositories\PostTypeRepositoryInterface;
use Molitor\Cms\Repositories\PostMetaRepository;
use Molitor\Cms\Repositories\PostMetaRepositoryInterface;
use Molitor\Cms\Repositories\PostRepository;
use Molitor\Cms\Repositories\PostRepositoryInterface;
use Molitor\Cms\View\Components\Content;
use Molitor\Cms\View\Components\ContentElement;
use Molitor\Cms\View\Components\ContentRegion as ContentRegionComponent;
use Molitor\Cms\View\Components\Menu;
use Molitor\Cms\View\Components\MenuItem;
use Molitor\Cms\View\Components\Pager;
use Molitor\Cms\View\Components\PostList;

class CmsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'cms');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'cms');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        $this->publishes([
            __DIR__.'/../config/cms.php' => config_path('cms.php'),
        ], 'cms-config');

        $this->mergeConfigFrom(
            __DIR__.'/../config/cms.php', 'cms'
        );

        // Register Blade components
        Blade::component('cms-content', Content::class);
        Blade::component('cms-content-element', ContentElement::class);
        Blade::component('cms-content-region', ContentRegionComponent::class);
        Blade::component('cms-menu', Menu::class);
        Blade::component('cms-menu-item', MenuItem::class);
        Blade::component('cms-post-list', PostList::class);
        Blade::component('cms-pager', Pager::class);

        $contentObserver = new ContentObserver;
        Page::observe($contentObserver);
        ContentRegion::observe($contentObserver);
    }

    public function register(): void
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(ContentRepositoryInterface::class, ContentRepository::class);
        $this->app->bind(ContentElementRepositoryInterface::class, ContentElementRepository::class);
        $this->app->bind(ContentElementTypeRepositoryInterface::class, ContentElementTypeRepository::class);
        $this->app->bind(PostGroupRepositoryInterface::class, PostGroupRepository::class);
        $this->app->bind(PostTypeRepositoryInterface::class, PostTypeRepository::class);
        $this->app->bind(PageTypeRepositoryInterface::class, PageTypeRepository::class);
        $this->app->bind(ContentRegionRepositoryInterface::class, ContentRegionRepository::class);
        $this->app->bind(PageRepositoryInterface::class, PageRepository::class);
        $this->app->bind(MenuRepositoryInterface::class, MenuRepository::class);
        $this->app->bind(MenuItemRepositoryInterface::class, MenuItemRepository::class);
        $this->app->bind(AuthorRepositoryInterface::class, AuthorRepository::class);
        $this->app->bind(PageMetaRepositoryInterface::class, PageMetaRepository::class);
        $this->app->bind(PostMetaRepositoryInterface::class, PostMetaRepository::class);
    }
}
