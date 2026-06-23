<?php

declare(strict_types=1);

namespace Molitor\Cms\Services;

use Molitor\Cms\Models\MenuItem;
use Molitor\Cms\Repositories\MenuItemRepositoryInterface;
use Molitor\Cms\Repositories\MenuRepositoryInterface;
use Molitor\Language\Services\LanguageService;
use Molitor\Menu\Services\Menu;
use Molitor\Menu\Services\MenuBuilder;
use Molitor\Menu\Services\TreeHelper;

class CmsMenuBuilder extends MenuBuilder
{
    public function init(Menu $menu, string $name, array $params = []): void
    {
        /** @var LanguageService $languageService */
        $languageService = app(LanguageService::class);

        $language = $languageService->getCurrentLanguage();
        if (! $language) {
            return;
        }

        /** @var MenuRepositoryInterface $menuRepository */
        $menuRepository = app(MenuRepositoryInterface::class);
        $menuRecord = $menuRepository->getByName($name, $language);

        if (! $menuRecord) {
            return;
        }

        /** @var MenuItemRepositoryInterface $menuItemRepository */
        $menuItemRepository = app(MenuItemRepositoryInterface::class);

        $items = $menuItemRepository->getByMenuId($menuRecord->id);

        $tree = new TreeHelper($menu);

        /** @var MenuItem $item */
        foreach ($items as $item) {
            $menuItem = new \Molitor\Menu\Services\MenuItem($item->label);
            $menuItem->setUrl($item->url);
            $menuItem->setIcon($item->icon);
            $tree->addItem($item->id, $item->parent_id, $menuItem);
        }

    }
}
