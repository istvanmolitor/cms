<?php

declare(strict_types=1);

namespace Molitor\Cms\Services;

use Molitor\Cms\Models\MenuItem;
use Molitor\Cms\Repositories\MenuItemRepositoryInterface;
use Molitor\Cms\Repositories\MenuRepositoryInterface;
use Molitor\Cms\Repositories\PostGroupRepositoryInterface;
use Molitor\Cms\Repositories\PostTypeRepositoryInterface;
use Molitor\Keyword\Repositories\KeywordRepositoryInterface;
use Molitor\Language\Services\LanguageService;
use Molitor\Menu\Services\Menu;
use Molitor\Menu\Services\MenuBuilder;
use Molitor\Menu\Services\TreeHelper;

class CmsMenuBuilder extends MenuBuilder
{
    public function init(Menu $menu, string $name, array $params = []): void
    {
        if($name === 'post_type') {
            $this->initPostTypeMenu($menu);
        }

        if($name === 'post_group') {
            $this->initPostGroupMenu($menu);
        }

        if($name === 'keyword') {
            $this->initKeywordMenu($menu);
        }

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

    protected function initPostTypeMenu(Menu $menu): void
    {
        /** @var PostTypeRepositoryInterface $postTypeRepository */
        $postTypeRepository = app(PostTypeRepositoryInterface::class);

        foreach ($postTypeRepository->getAll() as $postType) {
            $menu->addItem($postType->name, route('cms.post-type.show', $postType->slug))
                ->setName('post_type.'.$postType->slug);
        }
    }

    protected function initPostGroupMenu(Menu $menu): void
    {
        /** @var PostGroupRepositoryInterface $postGroupRepository */
        $postGroupRepository = app(PostGroupRepositoryInterface::class);

        foreach ($postGroupRepository->getAll() as $postGroup) {
            $menu->addItem($postGroup->name, route('cms.post-group.show', $postGroup->slug))
                ->setName('post_group.'.$postGroup->slug);
        }
    }

    protected function initKeywordMenu(Menu $menu): void
    {
        /** @var KeywordRepositoryInterface $keywordRepository */
        $keywordRepository = app(KeywordRepositoryInterface::class);

        foreach ($keywordRepository->getMostUsed(10) as $keyword) {
            $menu->addItem($keyword->name, route('cms.tag.show', $keyword->slug))
                ->setName('keyword.'.$keyword->slug);
        }
    }
}
