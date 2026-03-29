<?php

declare(strict_types=1);

namespace Molitor\Cms\Services;

use Molitor\Cms\Repositories\MenuItemRepositoryInterface;
use Molitor\Cms\Repositories\MenuRepositoryInterface;
use Molitor\Language\Repositories\LanguageRepositoryInterface;
use Molitor\Language\Services\LanguageService;
use Molitor\Menu\Services\Menu;
use Molitor\Menu\Services\MenuBuilder;

class CmsMenuBuilder extends MenuBuilder
{
    public function init(Menu $menu, string $name, array $params = []): void
    {
        if ($name === 'admin') {

            $cmsGroup = $menu->addItem('CMS', null);
            $cmsGroup->setName('cms');
            $cmsGroup->setIcon('file-alt');

            if (app()->routesAreCached() || count(app('router')->getRoutes()) > 0) {
                $cmsGroup->addItem('Pages', route('pages.index'))
                    ->setName('cms.pages')
                    ->setIcon('file');

                $cmsGroup->addItem('Regions', route('regions.index'))
                    ->setName('cms.regions')
                    ->setIcon('th-large');

                $cmsGroup->addItem('Authors', route('authors.index'))
                    ->setName('cms.authors')
                    ->setIcon('user-edit');

                $cmsGroup->addItem('Page Groups', route('page-groups.index'))
                    ->setName('cms.page-groups')
                    ->setIcon('layer-group');
            }
            return;
        }

        /** @var LanguageService $languageService */
        $languageService = app(LanguageService::class);

        $language = $languageService->getCurrentLanguage();
        if(!$language) {
            return;
        }

        /** @var MenuRepositoryInterface $menuRepository */
        $menuRepository = app(MenuRepositoryInterface::class);
        $menu = $menuRepository->getByName($name, $language);

        if(!$menu) {
            return;
        }

        /** @var MenuItemRepositoryInterface $menuItemRepository */
        $menuItemRepository = app(MenuItemRepositoryInterface::class);

        $items = $menuItemRepository->getByMenuName($name, $language);
    }
}
