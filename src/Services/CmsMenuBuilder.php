<?php

namespace Molitor\Cms\Services;

use Molitor\Cms\Models\MenuItem;
use Molitor\Cms\Repositories\MenuRepositoryInterface;
use Molitor\Menu\Services\Menu;
use Molitor\Menu\Services\MenuBuilder;
use Molitor\Menu\Services\TreeHelper;

class CmsMenuBuilder extends MenuBuilder
{
    public function init(Menu $menu, string $name, array $params = []): void
    {
        /** @var MenuRepositoryInterface $menuRepository */
        $menuRepository = app(MenuRepositoryInterface::class);

        $menuRecord = $menuRepository->getByName($name);
        if($menuRecord) {
            $tree = new TreeHelper($menu);

            /** @var MenuItem $menuItem */
            foreach ($menuRecord->menuItems as $menuItem) {
                $item = new \Molitor\Menu\Services\MenuItem($menuItem->label);
                $item->setUrl($menuItem->url);
                $item->setIcon($menuItem->icon);
                $item->setIsExternal($menuItem->is_external);
                $tree->addItem($menuItem->id, $menuItem->parent_id, $item);
            }
        }
    }
}
