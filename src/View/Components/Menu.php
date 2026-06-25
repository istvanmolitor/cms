<?php

declare(strict_types=1);

namespace Molitor\Cms\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Molitor\Cms\Repositories\MenuRepositoryInterface;
use Molitor\Cms\Services\CmsMenuBuilder;
use Molitor\Menu\Services\MenuManager;

class Menu extends Component
{
    public function __construct(
        protected MenuRepositoryInterface $menuRepository,
        protected string $name
    ) {}

    public function render(): View
    {
        /** @var MenuManager $menuManager */
        $menuManager = app(MenuManager::class);
        $menuManager->addMenuBuilder(new CmsMenuBuilder);
        $menu = $menuManager->build($this->name);

        return template('cms::components.main-menu', [
            'menu' => $menu,
        ]);
    }
}
