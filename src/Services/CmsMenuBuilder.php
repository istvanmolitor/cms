<?php

declare(strict_types=1);

namespace Molitor\Cms\Services;

use Molitor\Cms\Repositories\MenuRepositoryInterface;
use Molitor\Menu\Services\Menu;
use Molitor\Menu\Services\MenuBuilder;
use Molitor\Menu\Services\MenuItem;

class CmsMenuBuilder extends MenuBuilder
{
    private MenuRepositoryInterface $menuRepository;

    public function __construct()
    {
        $this->menuRepository = app(MenuRepositoryInterface::class);
    }

    public function init(Menu $menu, string $name, array $params = []): void
    {
        $cmsMenu = $this->menuRepository->getByName($name);

        if (!$cmsMenu) {
            return;
        }

        // Get top-level menu items
        $topLevelItems = $cmsMenu->topLevelItems()->with('children')->get();

        foreach ($topLevelItems as $cmsMenuItem) {
            $menuItem = $this->buildMenuItem($cmsMenuItem);
            $menu->addMenuItem($menuItem);
        }
    }

    /**
     * Build a MenuItem from a CMS MenuItem model
     */
    private function buildMenuItem(\Molitor\Cms\Models\MenuItem $cmsMenuItem): MenuItem
    {
        $menuItem = new MenuItem($cmsMenuItem->label ?? '');
        $menuItem->setUrl($cmsMenuItem->url ?? '#');

        if ($cmsMenuItem->icon) {
            $menuItem->setIcon($cmsMenuItem->icon);
        }

        if ($cmsMenuItem->is_external) {
            $menuItem->setIsExternal(true);
        }

        // Add children recursively
        if ($cmsMenuItem->children && $cmsMenuItem->children->count() > 0) {
            foreach ($cmsMenuItem->children as $child) {
                $childMenuItem = $this->buildMenuItem($child);
                $menuItem->addMenuItem($childMenuItem);
            }
        }

        return $menuItem;
    }
}

