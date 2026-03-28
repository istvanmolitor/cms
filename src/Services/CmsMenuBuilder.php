<?php

declare(strict_types=1);

namespace Molitor\Cms\Services;

use Molitor\Menu\Services\Menu;
use Molitor\Menu\Services\MenuBuilder;

class CmsMenuBuilder extends MenuBuilder
{
    public function init(Menu $menu, string $name, array $params = []): void
    {
        if ($name !== 'admin') {
            return;
        }

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
    }
}
