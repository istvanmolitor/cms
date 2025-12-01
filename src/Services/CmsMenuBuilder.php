<?php

namespace Molitor\Cms\Services;

use Molitor\Cms\Repositories\MenuRepositoryInterface;
use Molitor\Menu\Services\Menu;
use Molitor\Menu\Services\MenuBuilder;

class CmsMenuBuilder extends MenuBuilder
{
    public function init(Menu $menu, string $name, array $params = []): void
    {
        /** @var MenuRepositoryInterface $menuRepository */
        $menuRepository = app(MenuRepositoryInterface::class);

        $menuRecord = $menuRepository->getByName($name);
        if($menuRecord) {
            foreach ($menuRecord->items as $item) {
                $menu->addItem($item->label, $item->href)->setIcon($item->icon);
            }
        }
    }
}
